<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\User\UserRepository;
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
        $this->branch_offices = $branch_offices;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, UserRepository $userRepository)
    {
        $branch_offices = $this->branch_offices->paginate_search(10, $request->search, $request->status);

        $status = ['' => trans('app.selected_item')] + BranchOfficeStatus::lists();
        $representatives = ['' => ''] + $userRepository->lists_representative();

        if ( $request->ajax() ) {
            if (count($branch_offices)) {
                return response()->json([
                    'success' => true,
                    'view' => view('branch_offices.list', compact('branch_offices', 'status'))->render(),
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => trans('app.no_records_found')
                ]);
            }
        }

        return view('branch_offices.index', compact('branch_offices','status','representatives'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(UserRepository $userRepository)
    {
        $status = ['' => trans('app.selected_item')] + BranchOfficeStatus::lists();
        $representatives = ['' => ''] + $userRepository->lists_representative();

        return response()->json([
            'success' => true,
            'view' => view('branch_offices.create', compact('status','representatives'))->render()
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
        $data = [
            'name' => $request->name,
            'phone' => $request->phone,
            'representative_id' => $request->representative_id,
            'status' => BranchOfficeStatus::SERVICE,
            'created_by' => Auth::id(),
        ];
        $branch_office = $this->branch_offices->create($data);

        $locations = $request->address;
        $lat = $request->lat;
        $lng = $request->lng;

        if ( $branch_office ) {
            foreach( $locations as $key => $value ) {
                $this->branch_offices->create_location([ 
                    'branch_office_id' => $branch_office->id,
                    'address' => $value,           
                    'lat' => $lat[$key],
                    'lng' => $lng[$key]
                    ]
                );
            }

            return response()->json([
                'success' => true,
                'message' => trans('app.branch_office_created'),
                'url_return' => route('branch-office.edit', $branch_office->id)
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
    public function edit($id, UserRepository $userRepository)
    {
        $count = 1;
        $status = ['' => trans('app.selected_item')] + BranchOfficeStatus::lists();
        $representatives = $userRepository->lists_representative();

        if ( $branch_office = $this->branch_offices->find($id) ) {

            return response()->json([
                'success' => true,
                'view' => view('branch_offices.edit', compact('branch_office','status','count','representatives'))->render()
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
    public function update(Request $request, $id)
    {
        $branch_office = $this->branch_offices->find($id);
        $locations_old = $branch_office->locations->toArray();
        $locations = $request->address;
        $lat = $request->lat;
        $lng = $request->lng;
        $location_id = $request->location_id;
        $delete_location = array();
        $branch_office_update = $this->branch_offices->update(
            $id, 
            $request->only('name', 'phone', 'representative_id', 'status')
        );

        if ( $branch_office_update ) {

            foreach( $locations as $key => $value ) {
                
                if((int)$location_id[$key] == 0) {
                    $this->branch_offices->create_location([ 
                        'branch_office_id' => $id,
                        'address' => $value,           
                        'lat' => $lat[$key],
                        'lng' => $lng[$key]
                        ]
                    );
                } else {
                    foreach ($locations_old as $loc_old) {
                       if ( in_array($loc_old['id'], $location_id)  ) {
                           $this->branch_offices->update_location(
                                (int)$location_id[$key],
                                [ 
                                'address' => $value,           
                                'lat' => $lat[$key],
                                'lng' => $lng[$key]
                                ]
                            );
                       } else {
                            $this->branch_offices->delete_location($loc_old['id']);
                       }
                    }
                }      
            }

            return response()->json([
                'success' => true,
                'message' => trans('app.branch_office_updated'),
                'url_return' => route('branch-office.edit', $id)
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
        if ( $this->branch_offices->delete($id) ) {
            return response()->json([
                'success' => true,
                'message' => trans('app.branch_office_deleted')
            ]);
        } else {
            return response()->json([
                'success'=> false,
                'message' => trans('app.error_again')
            ]);
        }
    }
}
