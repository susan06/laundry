<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Repositories\User\UserRepository;
use App\Repositories\Driver\DriverRepository;
use App\Support\User\UserStatus;
use App\Support\Order\OrderStatus;
use App\Repositories\Order\OrderRepository;
use App\Repositories\BranchOffice\BranchOfficeRepository;

class DriverController extends Controller
{
    /**
     * @var OrderRepository
     */
    private $orders;

    /**
     * @var UserRepository
     */
    private $users;

    /**
     * @var DriverRepository
     */
    private $drivers;

    /**
     * UserController constructor.
     * @param UserRepository $users
     * @param DriverRepository $drivers
     * @param OrderRepository $orders 
     */
    public function __construct(
        UserRepository $users, 
        DriverRepository $drivers,
        OrderRepository $orders 
    ){
        $this->middleware('auth');
        $this->middleware('locale'); 
        $this->middleware('timezone'); 
        $this->users = $users;
        $this->drivers = $drivers;
        $this->orders = $orders;
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
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
     * show list of activities by driver
     *
     * @return \Illuminate\Http\Response
     */
    public function activities(Request $request) 
    {
        $user = Auth::user();
        $activities = $this->drivers->activities($user->id, $request->search);
        if ( $request->ajax() ) {
            if (count($activities) > 0) {
                return response()->json([
                    'success' => true,
                    'view' => view('drivers.list_activities', compact('activities'))->render(),
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => trans('app.no_records_found')
                ]);
            }
        }

        return view('drivers.index_activities', compact('activities', 'user'));
    }

    /**
     * itinerary of driver
     *
     * @return \Illuminate\Http\Response
     */
    public function itinerary(Request $request) 
    {
        $driver = Auth::user();
        $status_driver = ['' => trans('app.all_status_driver')] + OrderStatus::listsDrivers();
        $orders = $this->orders->itinerary_driver(10, $driver, $request->search, $request->status);
        if ( $request->ajax() ) {
            if (count($orders) > 0) {
                return response()->json([
                    'success' => true,
                    'view' => view('drivers.itinerary.list', compact('orders'))->render(),
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => trans('app.no_records_found')
                ]);
            }
        }

        return view('drivers.itinerary.index', compact('orders', 'status_driver'));
    }

     /**
     * taked order by driver
     *
     */
    public function takedOrder($id, Request $request)
    {
        $driver = Auth::user();

        $data = [
            'driver_id' => $driver->id,
            'status' => OrderStatus::recoge,
        ];
        $order = $this->orders->update($id, $data);

        if ($order) {
            $activity = $this->drivers->create_activity([
                'user_id' => $driver->id,
                'description' => trans('driver.taked_order', ['order' => $order->bag_code, 'client' => $order->user->full_name(), 'address' => $order->client_location->address])
            ]);

            return response()->json([
                'success' => true,
                'url_return' => route('driver.order.branch.list', $order->id),
                'message' => trans('app.taked_commodity_satisfactorily')
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => trans('app.error_again')
            ]);
        }
        
    }

    /**
     * Add method payment to order.
     *
     * @return \Illuminate\Http\Response
     */
    public function list_branch($id, Request $request, BranchOfficeRepository $branchOfficeRepository)
    {
        $order = $this->orders->find($id);
        $all_branch_offices = $branchOfficeRepository->all_active();

        return view('branch_offices.select_branch', compact('order', 'all_branch_offices'));
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

}
