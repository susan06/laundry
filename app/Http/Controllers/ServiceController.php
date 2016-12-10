<?php

namespace App\Http\Controllers;

use Auth;
use Settings;
use Validator;
use Illuminate\Http\Request;
use App\Repositories\Client\ClientRepository;
use App\Repositories\Package\PackageRepository;
use App\Repositories\Order\OrderRepository;
use App\Repositories\Payment\PaymentRepository;

class ServiceController extends Controller
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
     * ServiceController constructor.
     * @param 
     */
    public function __construct(
        OrderRepository $orders,
        ClientRepository $clients
    )
    {
        $this->middleware('auth');
        $this->orders = $orders;
        $this->clients = $clients;
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
    public function index()
    {
        //
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //foreach ($working_hours as $key => $working) {
           // if ($working['id'] == $time_search) {
                //$working_hour = $working;
           // }
       // }
        if($total_reserve > $quantity) {
            return response()->json([
                'success' => false,
                'message' => trans('app.quantity_reserve_overcome')
            ]);
        } else {
            return true;
        }

    }

}
