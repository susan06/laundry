<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

use App\Http\Requests;
use App\Repositories\BranchOffice\BranchOfficeRepository;
use App\Repositories\User\UserRepository;
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
        $branch_offices = $this->branch_offices->paginate_search(10, $request->search);

        $status = ['' => trans('app.selected_item')] + BranchOfficeStatus::lists();
        $representatives = ['' => trans('app.selected_item')] + $userRepository->lists_representative();

        if ( $request->ajax() ) {
            if (count($branch_offices)) {
                return response()->json([
                    'success' => true,
                    'view' => view('branch_offices.list', compact('branch_offices'))->render(),
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
        $edit = false;
        $status = ['' => trans('app.selected_item')] + BranchOfficeStatus::lists();
        $representatives = ['' => trans('app.selected_item')] + $userRepository->lists_representative();

        return response()->json([
            'success' => true,
            'view' => view('branch_offices.create-edit', compact('user','edit','status','representatives'))->render()
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
        if ( $branch_office ) {

            return response()->json([
                'success' => true,
                'message' => trans('app.branch_office_created')
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
        $edit = true;
        $status = ['' => trans('app.selected_item')] + BranchOfficeStatus::lists();
        $representatives = ['' => trans('app.selected_item')] + $userRepository->lists_representative();

        if ( $branch_office = $this->branch_offices->find($id) ) {
            return response()->json([
                'success' => true,
                'view' => view('branch_offices.create-edit', compact('branch_office','edit','status','representatives'))->render()
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
        $branch_office = $this->branch_offices->update(
            $id, 
            $request->only('name', 'phone', 'representative_id', 'status')
        );
        if ( $branch_office ) {

            return response()->json([
                'success' => true,
                'message' => trans('app.branch_office_updated')
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
