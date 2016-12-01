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
                'details' => $package->toJson(),
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

        if ( $request->ajax() ) {
            if (count($packages) >= 1) {
                return response()->json([
                    'success' => true,
                    'view' => view('packages.show_modal_by_category', compact('packages'))->render(),
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => trans('app.no_records_found')
                ]);
            }
        }

        return view('packages.show_modal_by_category', compact('packages'));
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
}
