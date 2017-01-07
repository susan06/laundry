<?php

namespace App\Http\Controllers;

use Auth;
use DateTime;
use Validator;
use App\User;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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
        $this->middleware('locale'); 
        $this->middleware('timezone'); 
        $this->users = $users;
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
            'name' => 'required|min:3',
            'lastname' => 'required|min:3',
            'phone_mobile' => 'required|numeric|min:9'
        ];

        if ($id) {
            $rules['email'] = 'required|email|max:255|unique:users,email,'.$id;
        } else {
            $rules['email'] = 'required|email|max:255|unique:users';
        }

        return Validator::make($data, $rules);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = Auth::user();

        if ( $request->ajax() ) {
            return response()->json([
                'success' => true,
                'view' => view('users.list_profile_data', compact('user'))->render(),
            ]);     
        }

        return view('users.profile', compact('user'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request)
    {
        if ( $user = $this->users->find($id) ) {
            $phones_array = json_decode($user->phones, true);
            $phones['phone_mobile'] = isset($phones_array['phone_mobile']) ?  $phones_array['phone_mobile'] : null;
            $phones['phone_home'] = isset($phones_array['phone_home']) ?  $phones_array['phone_home'] : null;

            return response()->json([
                'success' => true,
                'view' => view('users.edit-profile', compact('user', 'phones'))->render()
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
            $data = [
                'name' => $request->name,
                'lastname' => $request->lastname,
                'email' => $request->email,
                'phones' => '{"phone_mobile":"'.$request->phone_mobile.'","phone_home":"'.$request->phone_home.'"}',
                'birthday' => $request->birthday
            ];

            $user = $this->users->update($id, $data);
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
        } else {
            $messages = $validator->errors()->getMessages();

            return response()->json([
                'success' => false,
                'validator' => true,
                'message' => $messages
            ]);

        }
    }

    public function show()
    {
        //
    }


    /**
     * Get a validator for avatar
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator_avatar(array $data)
    {
        $rules = [
            'avatar' => 'required|image|dimensions:min_width=200,min_height=150',
        ];

        return Validator::make($data, $rules);
    }

    public function updateAvatar(Request $request)
    {
        $validator = $this->validator_avatar($request->only('avatar'));
        if ( $validator->passes() ) {
            $file = $request->avatar;
            $date = new DateTime();
            if(Auth::user()->avatar){
                $file_name = Auth::user()->avatar;
            } else {
                $file_name = $date->getTimestamp().'.'.$file->extension();
            }
            if($file){
                if ($file->isValid()) {
                    \File::delete(storage_path('app/users').'/'.$file_name);
                    Storage::delete($file_name);
                    $date = new DateTime();
                    $file_name = $date->getTimestamp().'.'.$file->extension();
                    $path = $file->storeAs('users', $file_name);
                }else{

                    return back()->withError(trans('app.error_upload_file'));
                }
            }
            $data = [
                'avatar' => $file_name
            ];
            $user = $this->users->update(Auth::user()->id, $data);
   
            if ( $user ) {

                return back()->withSuccess(trans('app.update_photo')); 
            } else {
                
                return back()->withError(trans('app.error_again'));
            }
        } else {
            $messages = $validator->errors()->getMessages();

            return back()->withErrors($messages);
        }
       
    }

}
