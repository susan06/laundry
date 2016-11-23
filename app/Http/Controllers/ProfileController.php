<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

use App\User;
use App\Http\Requests;
use App\Repositories\User\UserRepository;
use App\Repositories\Role\RoleRepository;
use App\Http\Requests\User\CreateUser;
use App\Http\Requests\User\UpdateUser;
use App\Http\Requests\Profile\UpdateProfile;
use App\Support\User\UserStatus;

class ProfileController extends Controller
{
    /**
     * @var User
     */
    protected $theUser;
    /**
     * @var UserRepository
     */
    private $users;

    /**
     * UsersController constructor.
     * @param UserRepository $users
     */
    public function __construct(UserRepository $users)
    {
        $this->middleware('auth');
        $this->users = $users;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();

        return view('users.profile', compact('user'));
    }

    public function edit($id, Request $request, RoleRepository $roleRepository)
    {
        $edit = true;
        $role = ($request->role == 'true') ? true : false;
        $status = UserStatus::lists();
        $roles = $roleRepository->lists('display_name');
        if ( $user = $this->users->find($id) ) {
            return response()->json([
                'success' => true,
                'view' => view('users.edit-profile', compact('user','edit','status','roles', 'role'))->render()
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
    public function update(UpdateProfile $request, $id)
    {
        $user = $this->users->update(
            $id, 
            $request->only('name', 'lastname')
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

}
