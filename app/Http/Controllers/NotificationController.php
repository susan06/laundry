<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Notification\NotificationRepository;
use App\Repositories\Order\OrderRepository;

class NotificationController extends Controller
{

    /**
     * @var NotificationRepository
     */
    private $notifications;

    /**
     * NotificationController constructor.
     * 
     */
    public function __construct(NotificationRepository $notifications){
        $this->middleware('auth');
        $this->middleware('locale'); 
        $this->middleware('timezone'); 
        $this->notifications = $notifications;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $notifications = $this->notifications->where('driver_id', null)->get();
        $update = $this->notifications->where('driver_id', null)->update(['read_on' => true]);
        if ( $request->ajax() ) {
            if (count($notifications)) {
                return response()->json([
                    'success' => true,
                    'view' => view('notifications.list', compact('notifications'))->render(),
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => trans('app.no_records_found')
                ]);
            }
        }

        return view('notifications.index', compact('notifications'));
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
        if ( $this->notifications->delete($id) ) {
            return response()->json([
                'success' => true,
                'message' => trans('app.deleted_notification')
            ]);
        } else {
            return response()->json([
                'success'=> false,
                'message' => trans('app.error_again')
            ]);
        }
    }

    /**
     * Get count Notification for supervisor
     *
     * @return \Illuminate\Http\Response::JSON     
     */
    public function countNotificationSupervisor(Request $request)
    {
        return response()->json( 
            $this->notifications->countNotificationSupervisor() 
        );
    }

    /**
     * store notification for driver change branch
     *   
     */
    public function storeChangeBranch($id, Request $request, OrderRepository $orderRepository) 
    {
        $order = $orderRepository->find($id);

        $notification = $this->notifications->create([
           'driver_id' => $order->driver_id,
           'order_id' => $order->id, 
           'change_branch' => true,
           'description' => trans('app.transfer_driver_branch')
        ]);

        if ( $notification ) {

            return response()->json([
                'success' => true,
                'message' => trans('app.notification_send_driver')
            ]);
        } else {
            
            return response()->json([
                'success' => false,
                'message' => trans('app.error_again')
            ]);
        }
    }
}
