<?php

namespace App\Http\Controllers;

use Auth;
use DateTime;
use Validator;
use Illuminate\Http\Request;
use App\Repositories\Order\OrderRepository;
use App\Repositories\Payment\PaymentRepository;
use App\Repositories\Package\PackageRepository;

class OrderController extends Controller
{
     /**
     * @var OrderRepository
     */
    private $orders;

    /**
     * OrderController constructor.
     * @param OrderRepository $orders
     */
    public function __construct(OrderRepository $orders)
    {
        $this->middleware('auth');
        $this->orders = $orders;
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $rules = [
            'delivery_address' => 'required',
            'lat' => 'required',
            'lng' => 'required',
            'locations_labels' => 'required',
            'details_address' => 'max:500',
            'date_search' => 'required',
            'time_search' => 'required',
            'date_delivery' => 'required',
            'time_delivery' => 'required',
            'packages' => 'required',
            'special_instructions' => 'max:500',
            'total' => 'required',
        ];

        return Validator::make($data, $rules);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $date = DateTime::createFromFormat('d-m-Y', $request->search);
        if($date && $date->format('d-m-Y')) {
            $search = date_format(date_create($request->search), 'Y-m-d');
        } else {
            $search = $request->search;
        }
        $orders = $this->orders->paginate_search(10, $request->search, $request->status);
        
        $status = [
            '' => trans('app.all_status'), 
            true  => trans('app.confirmed'), 
            false  => trans('app.Unconfirmed')
        ];

        if ( $request->ajax() ) {
            if (count($orders)) {
                return response()->json([
                    'success' => true,
                    'view' => view('orders.list', compact('orders', 'status'))->render(),
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => trans('app.no_records_found')
                ]);
            }
        }

        return view('orders.index', compact('orders', 'status'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(PackageRepository $packageRepository)
    {
        if(Settings::get('working_hours')) {
            $working_hours = json_decode(Settings::get('working_hours'), true);
        } else {
            $working_hours = array();
        }
        if(Settings::get('week')) {
            $week = explode(',', Settings::get('week'));
        } else {
            $week = array();
        }
        if(Settings::get('delivery_hours')) {
            $time_delivery = json_decode(Settings::get('delivery_hours'), true);
        } else {
            $time_delivery = array();
        }
        $categories = ['' => trans('app.select_category')] + $packageRepository->lists_categories_actives();
        $locations_labels = $this->clients->lists_locations_labels(Auth::user()->id);
   
        return view('services.create', compact('locations_labels', 'working_hours', 'week', 'time_delivery', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $validator = $this->validator($request->all());
        if ( $validator->passes() ) {
            $client_id = Auth::user()->id;
            if ( $this->check_reserve($request->time_search) ) {
                $data_location = [
                    'client_id' => $client_id,
                    'lat' => $request->lat,
                    'lng' => $request->lng,
                    'address' => $request->delivery_address,
                    'label' => $request->locations_labels,
                    'description' => $request->details_address
                ];
                $location_id = $this->clients->create_update_location(
                    $client_id, 
                    $data_location 
                );
                $data_order = [
                    'bag_code' => rand(5,9000).'-'.date('H').date('i'),
                    'client_id' => $client_id,
                    'client_location_id' => $location_id,
                    'client_coupon_id' => $request->client_coupon_id,
                    'date_search' => $request->date_search,
                    'time_search' => $request->time_search,
                    'date_delivery' => $request->date_delivery,
                    'time_delivery' => $request->time_delivery,
                    'special_instructions' => $request->special_instructions,
                    'sub_total' => $request->sub_total,
                    'discount' => $request->discount,
                    'total' => $request->total
                ];
                $order = $this->orders->create($data_order);
                if ($order) {
                    $packages = $request->packages;
                    $prices = $request['prices_'.$request->time_delivery];
                    foreach( $packages as $key => $value ) {
                        $this->orders->create_package([ 
                            'order_id' => $order->id,
                            'name' => $value,
                            'price' => $prices[$key]
                            ]
                        );
                    }
                    return response()->json([
                        'success' => true,
                        'url_return' => route('order.payment', $order->id),
                        'message' => trans('app.order_created')
                    ]);
                } else {
                    return response()->json([
                        'success' => false,
                        'message' => trans('app.error_again')
                    ]);
                }
            }

        } else {
            $messages = $validator->errors()->getMessages();

            return response()->json([
                'success' => false,
                'validator' => true,
                'message' => $messages
            ]);
        }  
    }

    /**
     * 
     *
     * @param  int  $time_search
     */
    public function check_reserve($time_search)
    {
        $working_hours = json_decode(Settings::get('working_hours'), true);

        $quantity = array_filter($working_hours, function ($working) use ($time_search) {
            if ($working['id'] == $time_search) {
                return $working['quantity'];
            }
        });

        $total_reserve = $this->orders->where('time_search', $time_search)->get()->count();

        if($total_reserve > $quantity) {
            return response()->json([
                'success' => false,
                'message' => trans('app.quantity_reserve_overcome')
            ]);
        } else {
            return true;
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request)
    {
        $order = $this->orders->find($id);

        if ( $request->ajax() ) {

            return response()->json([
                'success' => true,
                'view' => view('orders.show_content', compact('order'))->render(),
            ]);
        }

        return view('orders.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function my_orders(Request $request)
    {
        $date = DateTime::createFromFormat('d-m-Y', $request->search);
        if($date && $date->format('d-m-Y')) {
            $search = date_format(date_create($request->search), 'Y-m-d');
        } else {
            $search = $request->search;
        }
        $orders = $this->orders->paginate_search(10, $request->search, $request->status, Auth::user()->id);
        
        $status = [
            '' => trans('app.all_status'), 
            true  => trans('app.confirmed'), 
            false  => trans('app.Unconfirmed')
        ];

       if ( $request->ajax() ) {
            if (count($orders)) {
                return response()->json([
                    'success' => true,
                    'view' => view('orders.list', compact('orders', 'status'))->render(),
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => trans('app.no_records_found')
                ]);
            }
        }

        return view('orders.index', compact('orders', 'status'));
    }

    /**
     * Get a validator of payment for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator_payment(array $data, $id = null)
    {
        $rules['payment_method_id'] = 'required';
        $rules['amount'] = 'required';

        if ($id) {
            $rules['reference'] = 'required|min:3|unique:orders_payments,reference,'.$id;
        } else {
           $rules['reference'] = 'required|min:3|unique:orders_payments,reference'; 
        }

        return Validator::make($data, $rules);
    }

    /**
     * Add method payment to order.
     *
     * @return \Illuminate\Http\Response
     */
    public function method_payment($id, PaymentRepository $methods, Request $request)
    {
        $modal = ($request->modal == 'true') ? true : false;
        $order = $this->orders->find($id);
        $payments = ['' => trans('app.select_method_payment')] + $methods->lists_payments();
        
        if ( $request->ajax() ) {
            if ($order) {
                return response()->json([
                    'success' => true,
                    'view' => view('orders.method_payments_content', compact('payments', 'order', 'modal'))->render(),
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => trans('app.no_records_found')
                ]);
            }
        }

        return view('services.method_payments', compact('payments', 'order','modal'));
    }

    /**
     * Store a newly payment created resource in storage.
     *
     * @param  int $order
     * @return \Illuminate\Http\Response
     */    
    public function method_payment_store($order, Request $request)
    {
        $validator = $this->validator_payment($request->all());
        if ( $validator->passes() ) {
            $data = [
                'order_id' => $order,
                'payment_method_id' => $request->payment_method_id,
                'reference' =>  $request->reference,
                'amount' => $request->amount,
                'status' => true,
            ];
            $payment = $this->orders->create_payment($data);
            if ($payment) {

                return response()->json([
                    'success' => true,
                    'url_return' => route('order.show', $order),
                    'message' => trans('app.order_payment_created')
                ]);
            } else {

                return response()->json([
                    'success' => false,
                    'message' => trans('app.error_again')
                ]);
            }
        } else {
            $messages = $validator->errors()->getMessages();

            return response()->json([
                'success' => false,
                'validator' => true,
                'message' => $messages
            ]);
        }
        
    }

    /**
     * Update payment created resource in storage.
     *
     * @param  int $order
     * @return \Illuminate\Http\Response
     */    
    public function method_payment_update($payment, Request $request)
    {
        $validator = $this->validator_payment($request->all(), $payment);
        if ( $validator->passes() ) {
            $data = [
                'payment_method_id' => $request->payment_method_id,
                'reference' =>  $request->reference,
                'amount' => $request->amount
            ];
            $payment = $this->orders->update_payment($payment, $data);
            if ($payment) {

                return response()->json([
                    'success' => true,
                    'message' => trans('app.order_payment_updated')
                ]);
            } else {

                return response()->json([
                    'success' => false,
                    'message' => trans('app.error_again')
                ]);
            }
        } else {
            $messages = $validator->errors()->getMessages();

            return response()->json([
                'success' => false,
                'validator' => true,
                'message' => $messages
            ]);
        }
        
    }
}
