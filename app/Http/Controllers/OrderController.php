<?php

namespace App\Http\Controllers;

use Auth;
use DateTime;
use Validator;
use Settings;
use Illuminate\Http\Request;
use App\Support\Order\OrderStatus;
use App\Repositories\Order\OrderRepository;
use App\Repositories\Client\ClientRepository;
use App\Repositories\Payment\PaymentRepository;
use App\Repositories\Package\PackageRepository;
use App\Repositories\Coupon\ClientCouponRepository;

class OrderController extends Controller
{
     /**
     * @var OrderRepository
     */
    private $orders;

     /**
     * @var ClientRepository
     */
    private $clients;

     /**
     * @var CouponRepository
     */
    private $coupons;

    /**
     * OrderController constructor.
     * @param OrderRepository $orders
     */
    public function __construct(
        OrderRepository $orders, 
        ClientRepository $clients,
        ClientCouponRepository $coupons
    )
    {
        $this->middleware('auth');
        $this->middleware('locale'); 
        $this->middleware('timezone'); 
        $this->orders = $orders;
        $this->clients = $clients;
        $this->coupons = $coupons;
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
            'client_location_id' => 'required',
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
        $orders = $this->orders->paginate_search(10, $request->search, null, $request->status);
        
        $status = [
            '' => trans('app.all_status_order'), 
            true  => trans('app.confirmed'), 
            false  => trans('app.Unconfirmed')
        ];
        $status_driver = ['' => trans('app.all_status_driver')] + OrderStatus::lists();

        if ( $request->ajax() ) {
            if (count($orders)) {
                return response()->json([
                    'success' => true,
                    'view' => view('orders.list', compact('orders', 'status', 'status_driver'))->render(),
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => trans('app.no_records_found')
                ]);
            }
        }

        return view('orders.index', compact('orders', 'status', 'status_driver'));
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
        $client = $this->clients->find(Auth::user()->id);
        $exist_address = false;
        foreach ($client->client_location as $key => $item) {
            if($item->status != 'on_hold'){
                $exist_address = true;
            }
        }

        return view('orders.create', compact('locations_labels', 'working_hours', 'week', 'time_delivery', 'categories', 'client', 'exist_address'));
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
                $data_order = [
                    'client_id' => $client_id,
                    'client_location_id' => $request->client_location_id,
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
                    if($request->client_coupon_id != 0) {
                        $coupon = $this->coupons->update(
                            $request->client_coupon_id,
                            ['status' => false]
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

        if(Auth::user()->role_id == 2) {
            $view = 'orders.show';
        } else {
            $view = 'orders.show_back';
        }

        return view($view, compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request)
    {
        $order = $this->orders->find($id);
        $porcentaje = Settings::get('penalty');
        $penalty = $order->total * ($porcentaje/100);
        if(Settings::get('working_hours')) {
            $working_hours = json_decode(Settings::get('working_hours'), true);
        } else {
            $working_hours = array();
        }
        $client = $this->clients->find(Auth::user()->id);
        if ( $request->ajax() ) {

            return response()->json([
                'success' => true,
                'view' => view('orders.edit', compact('order', 'penalty', 'porcentaje', 'working_hours', 'client'))->render(),
            ]);
        }

        return view('orders.edit', compact('order', 'penalty', 'porcentaje', 'working_hours', 'client'));
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
        $order_old = $this->orders->find($id);
        if( $order_old->client_location_id != $request->client_location_id ||
            $order_old->time_search != $request->time_search
        ) {
            $rules = [
                'client_location_id' => 'required',
                'time_search' => 'required'
            ];
            $validator = Validator::make($request->all(), $rules);
            if ( $validator->passes() ) {
                $order = $this->orders->update($id, $request->all());
                if ($order) {
                    if($order->before_hour_search() <= 3) {           
                        $percentage = Settings::get('penalty');
                        $penalty = $order->total * ($percentage/100);
                        $data = [
                            'order_id' => $order->id,
                            'percentage' => $percentage,
                            'amount' => $penalty,
                        ];
                        $payment = $this->orders->create_penalty($data);
                        if ($payment) {

                            return response()->json([
                                'success' => true,
                                'url_return' => route('order.payment.penalty', $order->id),
                                'title_next' => trans('method_payment_penalty'),
                                'message' => trans('app.order_updated')
                            ]);
                        } else {

                            return response()->json([
                                'success' => false,
                                'message' => trans('app.error_again')
                            ]);
                        }
                    }
                    return response()->json([
                        'success' => true,
                        'message' => trans('app.order_updated')
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
        } else {
            return response()->json([
                'success' => true,
                'message' => trans('app.order_no_change')
            ]);
        } 
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
        $orders = $this->orders->paginate_search(10, $request->search, Auth::user()->id, $request->status, null, $request->status_driver);
        $status_driver = ['' => trans('app.all_status_driver')] + OrderStatus::lists();
        $status = [
            '' => trans('app.all_status_order'), 
            true  => trans('app.confirmed'), 
            false  => trans('app.Unconfirmed')
        ];

       if ( $request->ajax() ) {
            if (count($orders)) {
                return response()->json([
                    'success' => true,
                    'view' => view('orders.list', compact('orders', 'status', 'status_driver'))->render(),
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => trans('app.no_records_found')
                ]);
            }
        }

        return view('orders.index', compact('orders', 'status', 'status_driver'));
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
            $rules['reference'] = 'required|min:3|numeric|unique:orders_payments,reference,'.$id;
        } else {
           $rules['reference'] = 'required|min:3|numeric|unique:orders_payments,reference'; 
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

        return view('orders.method_payments', compact('payments', 'order','modal'));
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

    /**
     * Add method payment to penalty.
     *
     * @return \Illuminate\Http\Response
     */
    public function method_payment_penalty($id, PaymentRepository $methods, Request $request)
    {
        $modal = ($request->modal == 'true') ? true : false;
        $order = $this->orders->find($id);
        $payments = ['' => trans('app.select_method_payment')] + $methods->lists_payments();
        
        if ( $request->ajax() ) {
            if ($order) {
                return response()->json([
                    'success' => true,
                    'view' => view('orders.method_payments_penalty_content', compact('payments', 'order', 'modal'))->render(),
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => trans('app.no_records_found')
                ]);
            }
        }

        return view('orders.method_payment_penalty', compact('payments', 'order','modal'));
    }

    /**
     * Update method payment to penalty
     *
     * @param  int $order
     * @return \Illuminate\Http\Response
     */    
    public function method_payment_penalty_update($payment, Request $request)
    {
        $rules['payment_method_id'] = 'required';
        $rules['amount'] = 'required';
        $rules['reference'] = 'required|min:3|numeric|unique:orders_penalty,reference,'.$payment;

        $validator = Validator::make($request->all(), $rules);
        if ( $validator->passes() ) {
            $data = [
                'payment_method_id' => $request->payment_method_id,
                'reference' =>  $request->reference,
                'amount' => $request->amount,
                'status' => true,
            ];
            $payment = $this->orders->update_penalty($payment, $data);
            if ($payment) {
                if(Auth::user()->role->name == 'supervisor') {
                    $route = route('admin-order.index'); 
                } else {
                    $route = route('order.index');    
                }
                
                return response()->json([
                    'success' => true,
                    'message' => trans('app.order_payment_updated'),
                    'url_return' => $route 
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

    public function changeBagCode($id, Request $request) 
    {
        $order = $this->orders->find($id);
        if ( $order ) {
            return response()->json([
                'success' => true,
                'view' => view('orders.edit_bag_code', compact('order'))->render()
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => trans('app.no_record_found')
            ]);
        }
    }

    public function updateBagCode($id, Request $request) 
    {
        $order = $this->orders->update($id, $request->all());

        if ( $order ) {

            return response()->json([
                'success' => true,
                'message' => trans('app.order_bag_code_updated')
            ]);
        } else {
            
            return response()->json([
                'success' => false,
                'message' => trans('app.error_again')
            ]);
        }
    }

}
