<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use Auth;
use App\User;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\User\UserRepository;
use App\Repositories\Role\RoleRepository;
use App\Http\Requests\User\CreateUser;
use App\Http\Requests\User\UpdateUser;
use App\Support\User\UserStatus;

use App\Client;


use App\Repositories\Client\ClientRepository;
use App\Http\Requests\Client\CreateClient;
use App\Http\Requests\Client\UpdateClient;
use App\Support\Client\ClientStatus;

class clientController extends Controller
{
    /**
     * @var ClientRepository
     */
    private $users;

    /**
     * UserController constructor.
     * @param UserRepository $roles
     */
    public function __construct(UserRepository $users)
    {
        $this->middleware('auth');
        $this->users = $users;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = $this->users->paginate_search(10, $request->search);
        if ( $request->ajax() ) {
            if (count($users)) {
                return response()->json([
                    'success' => true,
                    'view' => view('users.clients.list', compact('users'))->render(),
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => trans('app.no_records_found')
                ]);
            }
        }

        return view('users.clients.index', compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, RoleRepository $roleRepository)
    {
        $edit = false;
        $role = ($request->role == 'true') ? true : false;
        $status = ['' => trans('app.selected_item')] + UserStatus::lists();
        $roles = ['' => trans('app.selected_item')] + $roleRepository->lists('display_name');

        return response()->json([
            'success' => true,
            'view' => view('users.clients.create', compact('edit','status','roles', 'role'))->render()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateClient $request)
    {
        $dataUser = [
            'name' => $request->name,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'role_id' => $request->role_id,
            'status' => $request->status,
            'password' => bcrypt(str_random(6))
        ];
        $user = $this->users->create($dataUser);

        if ( $user ) {

            return response()->json([
                'success' => true,
                'message' => trans('app.user_created')
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
    public function edit($id, Request $request, RoleRepository $roleRepository)
    {
        $edit = true;
        $role = ($request->role == 'true') ? true : false;
        $status = UserStatus::lists();
        $roles = $roleRepository->lists('display_name');
        if ( $user = $this->users->find($id) ) {
            return response()->json([
                'success' => true,
                'view' => view('users.clients.edit', compact('user','edit','status','roles', 'role'))->render()
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
    public function update(UpdateClient $request, $id)
    {
        $user = $this->users->update(
            $id, 
            $request->only('name', 'lastname', 'role_id', 'status')
        );
        if ( $user ) {

            return response()->json([
                'success' => true,
                'message' => trans('app.user_updated')
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
        if ( $id == Auth::id() ) {
            return response()->json([
                'success' => false,
                'message' => trans('app.you_cannot_delete_yourself')
            ]);
        }

        if ( $this->users->delete($id) ) {
            return response()->json([
                'success' => true,
                'message' => trans('app.deleted_user')
            ]);
        } else {
            return response()->json([
                'success'=> false,
                'message' => trans('app.error_again')
            ]);
        } 
    }
    
    
}
