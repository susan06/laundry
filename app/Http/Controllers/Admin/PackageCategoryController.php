<?php

namespace App\Http\Controllers\Admin;

use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Package\PackageRepository;

class PackageCategoryController extends Controller
{
     /**
     * @var PackageRepository
     */
    private $categories;

    /**
     * PackageController constructor.
     * @param PackageRepository $packages
     */
    public function __construct(PackageRepository $categories)
    {
        $this->middleware('auth');
        $this->middleware('locale'); 
        $this->middleware('timezone'); 
        $this->categories = $categories;
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data, $id = null)
    {
        if ($id) {
            $rules['name'] = 'required|unique:package_categories,name,'.$id;
            $rules['status'] = 'required';
        } else {
            $rules['name'] = 'required|unique:package_categories,name';
        }

        return Validator::make($data, $rules);
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
        $categories = $this->categories->paginate_search_categories(10, $request->search, $status);
        $status = [
            '' => trans('app.all_status'), 
            true  => trans('app.Published'), 
            false  => trans('app.No Published')
        ];
        if ( $request->ajax() ) {
            if (count($categories)) {
                return response()->json([
                    'success' => true,
                    'view' => view('packages.categories.list', compact('categories','status'))->render(),
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => trans('app.no_records_found')
                ]);
            }
        }

        return view('packages.categories.index', compact('categories', 'status'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $edit = false;

        return response()->json([
            'success' => true,
            'view' => view('packages.categories.create-edit', compact('edit'))->render()
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
            $category = $this->categories->create_category($request->all());
            if ( $category ) {

                return response()->json([
                    'success' => true,
                    'message' => trans('app.category_created')
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
        if ( $category = $this->categories->find_category($id) ) {

            $list_status = [
                true  => trans('app.Published'), 
                false  => trans('app.No Published')
            ];
            return response()->json([
                'success' => true,
                'view' => view('packages.categories.create-edit', compact('category','list_status','edit'))->render()
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
           $category = $this->categories->update_category(
                $id, 
                $request->all()
            );
            if ( $category ) {

                return response()->json([
                    'success' => true,
                    'message' => trans('app.category_updated')
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
        $delete = $this->categories->can_delete_category($id);

        if ( $delete['success'] ) {
            return response()->json([
                'success' => true,
                'message' => trans('app.category_deleted')
            ]);
        } else {
            return response()->json([
                'success'=> false,
                'message' => $delete['message']
            ]);
        }
    }
}
