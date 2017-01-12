<?php

namespace App\Http\Controllers\Admin;

use Auth;
use Validator;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\User\UserRepository;
use App\Repositories\BranchOffice\BranchOfficeRepository;
use App\Support\BranchOffice\BranchOfficeStatus;
use App\Support\BranchOffice\BranchServicesStatus;

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
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data, $id = null)
    {
        $rules = [
            'phone' => 'required|numeric|min:9',
            'representative_id' => 'required'
        ];

        if ($id) {
            $rules['name'] = 'required|min:3|unique:branch_offices,name,'.$id;
            $rules['status'] = 'required';
        } else {
            $rules['name'] = 'required|min:3|unique:branch_offices';
        }

        return Validator::make($data, $rules);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, UserRepository $userRepository)
    {
        $branch_offices = $this->branch_offices->paginate_search(10, $request->search, $request->status);
        $all_branch_offices = $this->branch_offices->all();
        $status = ['' => trans('app.selected_item')] + BranchOfficeStatus::lists();

        if ( $request->ajax() ) {
            if (count($branch_offices)) {
                return response()->json([
                    'success' => true,
                    'view' => view('branch_offices.list', compact('branch_offices', 'status', 'all_branch_offices'))->render(),
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => trans('app.no_records_found')
                ]);
            }
        }

        return view('branch_offices.index', compact('branch_offices','status', 'all_branch_offices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(UserRepository $userRepository)
    {
        $status = ['' => trans('app.selected_item')] + BranchOfficeStatus::lists();
        $representatives = ['' => trans('app.selected_item')] + $userRepository->lists_representative();

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
        $validator = $this->validator($request->all());
        if ( $validator->passes() ) {
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

            $services = $request->services_name;
            $prices = $request->services_prices;
            $service_status = $request->services_status;

            if ( $branch_office ) {
                if( $locations ){
                    foreach( $locations as $key => $value ) {
                        $this->branch_offices->create_location([ 
                            'branch_office_id' => $branch_office->id,
                            'address' => $value,           
                            'lat' => $lat[$key],
                            'lng' => $lng[$key]
                            ]
                        );
                    }
                }
                if ( $services ) {
                    foreach( $services as $key => $value ) {
                        $this->branch_offices->create_service([ 
                            'branch_office_id' => $branch_office->id,
                            'name' => $value,           
                            'price' => $prices[$key],
                            'status' => $service_status[$key]
                            ]
                        );
                    }
                }
                    
                return response()->json([
                    'success' => true,
                    'message' => trans('app.branch_office_created'),
                    'url_next' => route('branch-office.edit', $branch_office->id),
                    'title_next' => trans('app.edit_branch_office')
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
    public function edit($id, UserRepository $userRepository)
    {
        $count = 1;
        $status = BranchOfficeStatus::lists();
        $status_services = BranchServicesStatus::lists();
        $representatives = $userRepository->lists_representative();

        if ( $branch_office = $this->branch_offices->find($id) ) {

            return response()->json([
                'success' => true,
                'view' => view('branch_offices.edit', compact('branch_office','status','count','representatives', 'status_services'))->render()
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
        $validator = $this->validator($request->all(), $id);
        if ( $validator->passes() ) {
            $branch_office = $this->branch_offices->find($id);
            $locations = $request->address;
            $services = $request->services_name;      
            $branch_office_update = $this->branch_offices->update(
                $id, 
                $request->only('name', 'phone', 'representative_id', 'status')
            );

            if ( $branch_office_update ) {

                if ( $locations ) {
                    $locations_old = $branch_office->locations->toArray();
                    $lat = $request->lat;
                    $lng = $request->lng;
                    $location_id = $request->location_id;
                    $delete_location = array();
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
                }

                if ( $services ) {
                    $services_old = $branch_office->services->toArray();
                    $prices = $request->services_prices;
                    $service_status = $request->services_status;
                    $service_id = $request->service_id;
                    $delete_service = array();
                    foreach( $services as $key => $value ) {
                        
                        if((int)$service_id[$key] == 0) {
                            $this->branch_offices->create_service([ 
                                'branch_office_id' => $id,
                                'name' => $value,           
                                'price' => $prices[$key],
                                'status' => $service_status[$key]
                                ]
                            );
                        } else {
                            foreach ($services_old as $serv_old) {
                               if ( in_array($serv_old['id'], $service_id)  ) {
                                   $this->branch_offices->update_service(
                                        (int)$service_id[$key],
                                        [ 
                                        'name' => $value,           
                                        'price' => $prices[$key],
                                        'status' => $service_status[$key]
                                        ]
                                    );
                               } else {
                                    $this->branch_offices->delete_service($serv_old['id']);
                               }
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

    /**
     * Display map of locations
     *
     * @return \Illuminate\Http\Response
     */
    public function locations()
    {
        return response()->json([
            'success' => true,
            'view' => view('branch_offices.map')->render()
        ]);
    }
}
