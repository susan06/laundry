<?php

namespace App\Http\Controllers;

use Auth;
use Validator;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests;
use App\Coupon;
use Carbon\Carbon;
use App\Mailers\UserMailer;
use App\Repositories\Coupon\CouponRepository;
use App\Repositories\Coupon\ClientCouponRepository;
use App\Repositories\User\UserRepository;
use App\Http\Requests\Coupon\CreateCoupon;
use App\Http\Requests\Coupon\UpdateCoupon;
use App\Support\Coupon\CouponStatus;

class CouponController extends Controller
{
    /**
     * @var CouponRepository
     */
    private $coupons;

    /**
     * CouponController constructor.
     * @param CouponRepository $coupons
     */
    public function __construct(CouponRepository $coupons)
    {
        $this->middleware('auth');
        $this->middleware('locale'); 
        $this->middleware('timezone'); 
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
        $rules['code'] = 'required';
        $rules['validity'] = 'required|date';
        $rules['percentage'] = 'required';

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

        $code = str_random(15);
        $coupons = $this->coupons->paginate_search(10, $request->search, $request->status);
        $status = ['' => trans('app.all_status')] + CouponStatus::lists();
        if ( $request->ajax() ) {
            if (count($coupons)) {
                return response()->json([
                    'success' => true,
                    'view' => view('coupons.list', compact('coupons','status'))->render(),
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => trans('app.no_records_found')
                ]);
            }
        }

        return view('coupons.index', compact('coupons','code','status'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $edit = false;
        $code = str_random(15);

        return response()->json([
            'success' => true,
            'view' => view('coupons.create-edit', compact('edit','code'))->render()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateCoupon $request)
    {
        $data = [
            'code' => $request->code,
            'percentage' => $request->percentage,
            'validity' => $request->validity,
            'status' => CouponStatus::VALID,
            'created_by' => Auth::id(),
        ];
        $validator = $this->validator($data);
        if ( $validator->passes() ) {
            $coupon = $this->coupons->create($data);
            if ( $coupon ) {

                return response()->json([
                    'success' => true,
                    'message' => trans('app.coupon_created')
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
        $edit = true;
        if ( $coupon = $this->coupons->find($id) ) {
            $list_status = CouponStatus::lists();
            return response()->json([
                'success' => true,
                'view' => view('coupons.create-edit', compact('coupon','list_status','edit'))->render()
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => trans('app.no_record_found')
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCoupon $request, $id)
    {
        $data = [
            'percentage' => $request->percentage,
            'validity' => $request->validity,
            'status' => $request->status,
        ];
        $validator = $this->validator($data);
        if ( $validator->passes() ) {
            $coupon = $this->coupons->update(
                $id, 
                $data
            );
            if ( $coupon ) {

                return response()->json([
                    'success' => true,
                    'message' => trans('app.coupon_updated')
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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ( $this->coupons->delete($id) ) {
            return response()->json([
                'success' => true,
                'message' => trans('app.coupon_deleted')
            ]);
        } else {
            return response()->json([
                'success'=> false,
                'message' => trans('app.error_again')
            ]);
        }
    }

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function clients(Request $request, UserRepository $users)
    {
        $clients = $users->client_coupon_paginate_search(10, $request->search);

        if ( $request->ajax() ) {
            if (count($clients)) {
                return response()->json([
                    'success' => true,
                    'view' => view('coupons.clients.list', compact('clients'))->render(),
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => trans('app.no_records_found')
                ]);
            }
        }

        return view('coupons.clients.index', compact('clients'));
    }

    /**
     * check coupon
     *
     * @return \Illuminate\Http\Response JSON
     */
    public function check_coupon(Request $request, ClientCouponRepository $couponClient)
    {
        $code = $request->code;
        $coupon = null;
        foreach ($this->coupons->all() as $key => $item) {
            if(decrypt($item->code) == $code) {
                $coupon = $item;
            }
        };

        if ( $coupon && $coupon->status == 'Valid' && $coupon->validity >= Carbon::now()->format('d-m-Y') ) {

            $user = Auth::user();
            $coupon_client = $couponClient->where('coupon_id', $coupon->id)->where('client_id', $user->id)->first();

            if ($coupon_client) {
                if ( $coupon_client->isValid() ) {
                    return response()->json([
                        'success' => true,
                        'percentage' => (int)$coupon['percentage'],
                        'client_coupon_id' => $coupon_client->id,
                        'message' => trans('app.coupon_valid')
                    ]);
                } else {
                    return response()->json([
                        'success' => true,
                        'message' => trans('app.coupon_useless')
                    ]);
                }
            } else {
                return response()->json([
                    'success' => false,
                    'message' => trans('app.no_register_coupon_client')
                ]);
            }
        } else {
            return response()->json([
                'success' => false,
                'message' => trans('app.the_coupon_was_no_valid_by_adminitration')
            ]);
        }
    }

    /**
     * Show coupons of clients.
     *
     * @return \Illuminate\Http\Response
     */
    public function client_show($id, ClientCouponRepository $couponClient)
    {
        $coupons = $couponClient->where('client_id', $id)->get();

        return response()->json([
            'success' => true,
            'view' => view('coupons.clients.show', compact('coupons'))->render()
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendToClients($id, Request $request, UserRepository $userRepository)
    {
        $clients = $userRepository->client_send_coupon();
        $coupon = $this->coupons->find($id);

        return view('coupons.clients.send', compact('coupon', 'clients'));
    }

    public function sendStoreCouponsClients($id, Request $request, UserMailer $mailer, UserRepository $users)
    {
        $coupon = $this->coupons->find($id);
        $clients = $request->clients;
        if($clients) {
            foreach ($clients as $key => $value) {
                $send = $this->coupons->create_client_coupon([
                    'client_id' => $value,
                    'coupon_id' => $id
                ]);

                $mailer->sendCoupon($users->find($value), $coupon);
            }
        }

        return response()->json([
            'success' => true,
            'message' => trans('app.coupon_sended'),
            'url_return' => route('coupon.clients')
        ]);

    }
}
