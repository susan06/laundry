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
use App\Http\Requests\Profile\UpdateAvatar;
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

    public function show()
    {
        //
    }

    public function editAvatar($id, Request $request, RoleRepository $roleRepository)
    {
        $edit = true;
        $role = ($request->role == 'true') ? true : false;
        $status = UserStatus::lists();
        $roles = $roleRepository->lists('display_name');
        if ( $user = $this->users->find($id) ) {
            return response()->json([
                'success' => true,
                'view' => view('users.edit-avatar', compact('user','edit','status','roles', 'role'))->render()
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => trans('app.no_record_found')
            ]);
        }
    }

    public function updateAvatar(UpdateAvatar $request, $id)
    {
        $user = $this->users->find($id);
        $file = $request->avatar;
        $file_name = $user->avatar;
        if($file){
            if ($file->isValid()) {
                \File::delete(storage_path('storage/users').'/'.$file_name);
                Storage::delete($file_name);
                $date = new DateTime();
                $file_name = $date->getTimestamp().'.'.$file->extension();
                $path = $file->storeAs('user', $file_name);
            }else{

                return redirect()
                ->route('profile.index')
                ->withSuccess(trans('app.error_upload_file'));
            }
        }
        $data = [
            'avatar' => $file_name
        ];
        $users = $this->users->update($id, $data);
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
