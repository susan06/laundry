<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;
use App\Coupon;
use App\Repositories\Coupon\CouponRepository;
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
        $code = str_random(15);
        $coupons = $this->coupons->paginate(10, $request->search);
        if ( $request->ajax() ) {
            if (count($coupons)) {
                return response()->json([
                    'success' => true,
                    'view' => view('coupons.list', compact('coupons'))->render(),
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => trans('app.no_records_found')
                ]);
            }
        }

        return view('coupons.index', compact('coupons','code'));
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
            'code' => encrypt($request->code),
            'percentage' => $request->percentage,
            'validity' => date_format(date_create($request->validity), 'Y-m-d'),
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
            return response()->json([
                'success' => true,
                'view' => view('coupons.create-edit', compact('coupon','edit'))->render()
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
            'validity' => date_format(date_create($request->validity), 'Y-m-d'),
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
}
