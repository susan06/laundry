<?php

namespace App\Http\Controllers;

use Auth;
use DateTime;
use Validator;
use Illuminate\Http\Request;
use App\Repositories\Order\OrderRepository;
use App\Repositories\Payment\PaymentRepository;

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
        $order = $this->orders->find($id);

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
    public function method_payment($id, PaymentRepository $methods)
    {
        $order = $this->orders->find($id);
        $payments = ['' => trans('app.select_method_payment')] + $methods->lists_payments();
   
        return view('services.method_payments', compact('payments', 'order'));
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
