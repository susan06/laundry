<?php

namespace App\Http\Controllers;

use Auth;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Http\Requests;
use App\Coupon;
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
        $this->coupons = $coupons;
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

        $coupon = $this->coupons->all()->filter(function($record) use($code) {
            if(decrypt($record->code) == $code) {
                return $record;
            }
        })->values()->first()->toArray();

        if ( $coupon && $coupon['status'] == 'Valid' ) {

            $user = Auth::user();
            $coupon_client = $couponClient->where('coupon_id', $coupon['id'])->where('client_id', $user->id)->first();

            if ($coupon_client) {
                if ( $coupon_client->isValid() ) {
                    return response()->json([
                        'success' => true,
                        'percentage' => (int)$coupon['percentage'],
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
}
