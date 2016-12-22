<?php

namespace App\Http\Controllers;

use Auth;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Repositories\BranchOffice\BranchOfficeRepository;
use App\Support\BranchOffice\BranchOfficeStatus;

class BranchOfficeController extends Controller
{
    /**
     * @var BranchOfficeRepository
     */
    private $branch_offices;

    /**
     * BranchOfficeController constructor.
     * @param BranchOfficeRepository $branch_offices
     */
    public function __construct(BranchOfficeRepository $branch_offices)
    {
        $this->middleware('auth');
        $this->middleware('locale'); 
        $this->middleware('timezone'); 
        $this->branch_offices = $branch_offices;
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
}
