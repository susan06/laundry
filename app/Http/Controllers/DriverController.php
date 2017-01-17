<?php

namespace App\Http\Controllers;

use Auth;
use Validator;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Mailers\NotificationMailer;
use App\Repositories\User\UserRepository;
use App\Repositories\Driver\DriverRepository;
use App\Support\User\UserStatus;
use App\Support\Order\OrderStatus;
use App\Repositories\Order\OrderRepository;
use App\Repositories\BranchOffice\BranchOfficeRepository;
use App\Repositories\Client\ClientRepository;

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
        $title = trans('app.my_itinerary');
        $status_driver = ['' => trans('app.all_status_driver')] + OrderStatus::listsDrivers();
        $orders = $this->orders->itinerary_driver(10, true, $driver, $request->search, $request->status);
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

        return view('drivers.itinerary.index', compact('orders', 'status_driver', 'title'));
    }

    /**
     * itinerary of driver
     *
     * @return \Illuminate\Http\Response
     */
    public function itinerary_delivery(Request $request) 
    {
        $driver = Auth::user();
        $title = trans('app.order_delivered');
        $status_driver = ['' => trans('app.all_status_driver')] + OrderStatus::listsDrivers();
        $orders = $this->orders->itinerary_driver(10, null, $driver, $request->search, $request->status);
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

        return view('drivers.itinerary.index', compact('orders', 'status_driver', 'title'));
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
     */
    public function list_branch($id, Request $request, BranchOfficeRepository $branchOfficeRepository)
    {
        $order = $this->orders->find($id);
        $all_branch_offices = $branchOfficeRepository->all_active();
        $branch_offices = $branchOfficeRepository->all_active();

        return view('branch_offices.select_branch', compact('order', 'branch_offices', 'all_branch_offices'));
    }

    /**
     * update branch office of order by driver
     *
     */    
    public function update_branch_order($id, Request $request)
    {
        $rules = ['branch_office' => 'required'];
        $validator = Validator::make($request->all(), $rules);
        if ( $validator->passes() ) {
            $data = [
                'branch_offices_id' => $request->branch_office,
                'branch_offices_location_id' => $request->branch_location,
            ];
            $order = $this->orders->update($id, $data);
            if ($order) {

                $activity = $this->drivers->create_activity([
                    'user_id' => Auth::user()->id,
                    'description' => trans('driver.assign_branch_order', ['order' => $order->bag_code, 'branch' => $order->branch_office->name, 'address' => $order->location_branch()->address])
                ]);

                return response()->json([
                    'success' => true,
                    'url_return' => route('order.show', $order->id),
                    'message' => trans('app.order_branch_update', ['branch' => $order->branch_office->name])
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
     * in branch of driver
     *
     */
    public function inBranchOrder($id, Request $request, NotificationMailer $mailer)
    {
        $driver = Auth::user();
        $order = $this->orders->update($id, ['status' => OrderStatus::inbranch]);

        if ($order) {
            $mailer->sendNotificationStatusOrder($order);
            $activity = $this->drivers->create_activity([
                'user_id' => $driver->id,
                'description' => trans('driver.inbranch_order', ['order' => $order->bag_code, 'branch' => $order->branch_office->name])
            ]);

            return response()->json([
                'success' => true,
                'url_return' => route('driver.order.itinerary'),
                'message' => trans('app.change_status_order_branch')
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => trans('app.error_again')
            ]);
        }
        
    }

    /**
     * inexit of driver
     *
     */
    public function inexitOrder($id, Request $request, NotificationMailer $mailer)
    {
        $driver = Auth::user();
        $order = $this->orders->update($id, ['status' => OrderStatus::inexit]);

        if ($order) {
            $mailer->sendNotificationStatusOrder($order);
            $activity = $this->drivers->create_activity([
                'user_id' => $driver->id,
                'description' => trans('driver.inexit_order', ['order' => $order->bag_code, 'branch' => $order->branch_office->name])
            ]);

            return response()->json([
                'success' => true,
                'message' => trans('app.change_status_order_inexit')
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => trans('app.error_again')
            ]);
        }    
    }

    /**
     * inexit of driver
     *
     */
    public function deliveredOrder($id, Request $request, NotificationMailer $mailer, ClientRepository $clientRepository)
    {
        $driver = Auth::user();
        $order = $this->orders->update($id, ['status' => OrderStatus::delivered, 'date_delivered' => Carbon::now()]);
        $location = $order->client_location_id;
        $client_location = $clientRepository->update_status_location(
            $location, 
            ['confirmed' => true]
        );
        
        if ($order) {
            $mailer->sendNotificationStatusOrder($order);
            $activity = $this->drivers->create_activity([
                'user_id' => $driver->id,
                'description' => trans('driver.delivered_order', ['order' => $order->bag_code, 'branch' => $order->branch_office->name])
            ]);

            return response()->json([
                'success' => true,
                'message' => trans('app.change_status_order_delivered')
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => trans('app.error_again')
            ]);
        }
        
    }

}
