<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Package\PackageRepository;

class PackageController extends Controller
{
    /**
     * @var PackageRepository
     */
    private $packages;

    /**
     * PackageController constructor.
     * @param PackageRepository $packages
     */
    public function __construct(PackageRepository $packages)
    {
        $this->middleware('auth');
        $this->middleware('locale'); 
        $this->middleware('timezone'); 
        $this->packages = $packages;
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
     * Display the specified details.
     *
     * @param  Request $request
     * @return \Illuminate\Http\Response JSON
     */
    public function details(Request $request)
    {
        $package = $this->packages->find($request->id);

        if ($package) {
            return response()->json([
                'success' => true,
                'details' => ['name' => $package->name, 'category' => $package->package_category->name],
                'prices'  => $package->package_price->toJson()
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => trans('app.no_record_found')
            ]);
        }

    }

    /**
     * Display the specified resource by category.
     *
     * @param  Request $request
     * @return \Illuminate\Http\Response JSON
     */
    public function show_by_category(Request $request)
    {
        $packages = $this->packages
            ->where('package_category_id', $request->category)
            ->where('status', true)
            ->get();

        $time_select = $request->time_select;

        if ( $request->ajax() ) {
            if (count($packages) >= 1) {
                return response()->json([
                    'success' => true,
                    'view' => view('packages.show_modal_by_category', compact('packages', 'time_select'))->render(),
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => trans('app.no_records_found')
                ]);
            }
        }

        return view('packages.show_modal_by_category', compact('packages', 'time_select'));
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

    public function orderPreview(Request $request)
    {
        $pack = explode(',', substr($request->packages, 0, -1));
        $quantity = explode(',', substr($request->quantity, 0, -1));
        $time_delivery = $request->time;
        $packages = array();

        foreach ($pack as $key => $value) {
            $details = $this->packages->find($value);
            $packages[$key]['quantity'] = $quantity[$key];
            $packages[$key]['name'] = $details->name;
            $packages[$key]['category'] = $details->package_category->name; 
            foreach ($details->package_price as $package_price) {
                if($package_price->delivery_schedule == $time_delivery) {
                    $price = $package_price->price;
                }
            }
            
            $packages[$key]['price'] = $price;
        }

        return response()->json([
            'success' => true,
            'view' => view('packages.order_preview', compact('packages'))->render(),
        ]);
    }
}
