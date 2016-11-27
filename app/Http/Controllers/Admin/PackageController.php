<?php

namespace App\Http\Controllers\Admin;

use DateTime;
use Settings;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
    public function index(Request $request)
    {
        $status = null;
        if($request->status) {
            $status = ($request->status == 1) ? true : false;
        }
        $packages = $this->packages->paginate_search(10, $request->search, $status);
        $status = [
            '' => trans('app.all_status'), 
            true  => trans('app.Published'), 
            false  => trans('app.No Published')
        ];
        if ( $request->ajax() ) {
            if (count($packages)) {
                return response()->json([
                    'success' => true,
                    'view' => view('packages.list', compact('packages','status'))->render(),
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => trans('app.no_records_found')
                ]);
            }
        }

        return view('packages.index', compact('packages','status'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = ['' => ''] + $this->packages->lists_categories();
        if(Settings::get('delivery_hours')) {
            $delivery_hours = json_decode(Settings::get('delivery_hours'), true);
        } else {
            $delivery_hours = array();
        }
        return response()->json([
            'success' => true,
            'view' => view('packages.create', compact('categories','delivery_hours'))->render()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $file = $request->image;
        if($file){
            if ($file->isValid()) {
                $date = new DateTime();
                $file_name = 'packages/'.$date->getTimestamp().'.'.$file->extension();
                $path = $file->storeAs('packages', $file_name);
            }else{

                return redirect()
                ->route('admin-package.index')
                ->withSuccess(trans('app.error_upload_file'));
            }
        }
        $data = [
            'name' => $request->name,
            'package_category_id' => $request->package_category_id,
            'description' => $request->description,
            'image' => $file_name,
            'status' => true
        ];
        $package = $this->packages->create($data);
        $delivery_schedules = $request->delivery_schedule;
        $prices = $request->prices;
        if ( $package ) {
            foreach( $delivery_schedules as $key => $value ) {
                $this->packages->create_price([ 
                    'package_id' => $package->id,
                    'delivery_schedule' => $value,           
                    'price' => $prices[$key]
                    ]
                );
            }

            return redirect()
                ->route('admin-package.index')
                ->withSuccess(trans('app.package_created'));

        } else {
            
            return redirect()
                ->route('admin-package.index')
                ->withSuccess(trans('app.error_again'));
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
