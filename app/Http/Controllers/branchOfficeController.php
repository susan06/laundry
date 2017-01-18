<?php

namespace App\Http\Controllers;

use Auth;
use Validator;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Mailers\NotificationMailer;
use App\Support\Order\OrderStatus;
use App\Repositories\BranchOffice\BranchOfficeRepository;
use App\Support\BranchOffice\BranchOfficeStatus;
use App\Repositories\Order\OrderRepository;
use App\Repositories\Notification\NotificationRepository;

class BranchOfficeController extends Controller
{
    /**
     * @var OrderRepository
     */
    private $orders;

    /**
     * @var BranchOfficeRepository
     */
    private $branch_offices;

    /**
     * BranchOfficeController constructor.
     * @param BranchOfficeRepository $branch_offices
     */
    public function __construct(
        BranchOfficeRepository $branch_offices,
        OrderRepository $orders 
    ){
        $this->middleware('auth');
        $this->middleware('locale'); 
        $this->middleware('timezone'); 
        $this->branch_offices = $branch_offices;
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
     * Show services
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function services($id)
    {
        $branch_office = $this->branch_offices->find($id);

        if ( $branch_office->services ) {

            return response()->json([
                'success' => true,
                'view' => view('branch_offices.list_services', compact('branch_office'))->render()
            ]);
        } else {

            return response()->json([
                'success' => false,
                'message' => trans('app.no_record_found')
            ]);
        }
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
     * select in session list branch
     *
     */
    public function select_branch(Request $request)
    {
        $branch_offices_all = $this->branch_offices->where('representative_id', Auth::user()->id)->where('status', 'In service')->pluck('name', 'id')->all();
        $branch_office = $this->branch_offices->where('representative_id', Auth::user()->id)->where('status', 'In service')->first();
        
        if ($request->branch_office_id) {
            $branch_office = $this->branch_offices->find($request->branch_office_id);
            session()->put('branch_office', $branch_office); 
        }

        if ( count($branch_offices_all) > 1 && !session('branch_offices')) {
            $branch_offices = ['' => trans('app.select_a_branch_office')] + $branch_offices_all;
            session()->put('branch_offices', $branch_offices); 
        } else {
            if(!session('branch_office')) {
                session()->put('branch_office', $branch_office); 
            }
        }
    }
    /**
     * list order in branch offices
     *
     * @return \Illuminate\Http\Response
     */
    public function orders($status, Request $request) 
    {
        $this->select_branch($request);
        if ($status == 'inbranch') {
            $title = trans('app.order_in_branch');
        } else {
            $title = trans('app.order_complete');
        }
        $orders = $this->orders->itinerary_branch(10, $status, $request->search);
        if ( $request->ajax() ) {
            if (count($orders) > 0) {
                return response()->json([
                    'success' => true,
                    'view' => view('branch_offices.orders.list', compact('orders'))->render(),
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => trans('app.no_records_found')
                ]);
            }
        }

        return view('branch_offices.orders.index', compact('orders', 'title'));
    }

    /**
     * complete order
     *
     */
    public function completeOrder($id, Request $request, NotificationMailer $mailer, NotificationRepository $notificationRepository)
    {
        $order = $this->orders->update($id, ['status' => OrderStatus::branch_finish]);
        
        if ($order) {
            $mailer->sendNotificationStatusOrderDriver($order);
            
            $notification = $notificationRepository->create([
                'driver_id' => $order->driver_id,
                'description' => trans('driver.complete_order', ['order' => $order->bag_code, 'branch' => $order->branch_office->name])
            ]);

            return response()->json([
                'success' => true,
                'message' => trans('app.change_status_order_complete')
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => trans('app.error_again')
            ]);
        }      
    }

    /**
     * form reazon for change branch
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function reasonChangeBranch($id, Request $request)
    {
        $order = $this->orders->find($id);

        return response()->json([
            'success' => true,
            'view' => view('orders.reazon_change_branch', compact('order'))->render()
        ]);  
    }

    /**
     * reazon Change Branch Update
     *
     */
    public function reasonIncompleteUpdate($id, Request $request, NotificationRepository $notificationRepository)
    {
        $rules = [ 'description' => 'required'];

        $validator = Validator::make($request->only('description'), $rules);
        if ( $validator->passes() ) {
            $order = $this->orders->update($id, ['status' => OrderStatus::change_branch]);       
            if ($order) {
                
                $notification = $notificationRepository->create([
                    'branch_office_id' => $order->branch_offices_id,
                    'description' => trans('app.reazon_change_branch_description', ['branch' => $order->branch_office->name, 'reason' => $request->description])
                ]);

                return response()->json([
                    'success' => true,
                    'message' => trans('app.change_status_order_change_branch')
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
