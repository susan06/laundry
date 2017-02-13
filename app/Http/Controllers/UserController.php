<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use Config;
use App;
use Session;
use Validator;
use App\User;
use DateTime;
use App\Http\Requests;
use App\Repositories\User\UserRepository;
use App\Repositories\Role\RoleRepository;
use App\Support\User\UserStatus;

class UserController extends Controller
{
    /**
     * @var UserRepository
     */
    private $users;

    /**
     * UserController constructor.
     * @param UserRepository $roles
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
            'status' => 'required',
            'phone_mobile' => 'required|numeric',
            'role_id' => 'required|exists:roles,id'
        ];

        if ($id) {
            $rules['email'] = 'required|email|unique:users,email,'.$id;
        } else {
            $rules['email'] = 'required|email|unique:users,email';
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
        $date = DateTime::createFromFormat('d-m-Y', $request->search);

        if($date && $date->format('d-m-Y')) {
            $search = date_format(date_create($request->search), 'Y-m-d');
        } else {
            $search = $request->search;
        }
        $users = $this->users->paginate_search(10, $request->search, $request->status);
        $status = ['' => trans('app.all_status')] + UserStatus::lists();
        if ( $request->ajax() ) {
            if (count($users)) {
                return response()->json([
                    'success' => true,
                    'view' => view('users.list', compact('users','status'))->render(),
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => trans('app.no_records_found')
                ]);
            }
        }

        return view('users.index', compact('users', 'status'));
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
            'view' => view('users.create-edit', compact('edit','status','roles', 'role'))->render()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\CreateUpdateUser  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = $this->validator($request->all());
        if ( $validator->passes() ) {
            $data = [
                'name' => $request->name,
                'lastname' => $request->lastname,
                'email' => $request->email,
                'role_id' => $request->role_id,
                'status' => $request->status,
                'phones' => '{"phone_mobile":"'.$request->phone_mobile.'","phone_home":"'.$request->phone_home.'"}',
                'birthday' => $request->birthday,
                'password' => 'secret',
                'status' => UserStatus::ACTIVE
            ];
            $user = $this->users->create($data);
            if ( $user ) {

                return response()->json([
                    'success' => true,
                    'message' => trans('app.user_created_defaut_pass')
                ]);
            } else {
                
                return response()->json([
                    'success' => false,
                    'message' => trans('app.error_again')
                ]);
            }

        } else {

            $messages = $validator->errors()->getMessages();

            if ( $request->ajax() ) {

                return response()->json([
                    'success' => false,
                    'validator' => true,
                    'message' => $messages
                ]);
            } 

            return back()->withErrors($messages); 
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
        $roles = $roleRepository->lists('display_name');
        $status = UserStatus::lists();
        $user = $this->users->find($id);
        $phones_array = json_decode($user->phones, true);
        $phones['phone_mobile'] = isset($phones_array['phone_mobile']) ?  $phones_array['phone_mobile'] : null;
        $phones['phone_home'] = isset($phones_array['phone_home']) ?  $phones_array['phone_home'] : null;

        if ( $user ) {
            return response()->json([
                'success' => true,
                'view' => view('users.create-edit', compact('user', 'phones', 'edit', 'role', 'roles', 'status' ))->render()
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
     * @param  \Illuminate\Http\CreateUpdateUser  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response::JSON
     */
    public function update(Request $request, $id)
    {
        $validator = $this->validator($request->all(), $id);
        if ( $validator->passes() ) {
            $data = [
                'name' => $request->name,
                'lastname' => $request->lastname,
                'email' => $request->email,
                'role_id' => $request->role_id,
                'status' => $request->status,
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

            if ( $request->ajax() ) {

                return response()->json([
                    'success' => false,
                    'validator' => true,
                    'message' => $messages
                ]);
            } 

            return back()->withErrors($messages);
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

    /**
     * Change password
     *
     */
    public function password() {

        if(Auth()->user()->role_id == 2) {
            $view = 'users.change_password';
        } else {
            $view = 'users.change_password_back';
        }

        return view($view);
    }

    /**
     * Get a validator for change password.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator_password(array $data)
    {
        $rules = [
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required|min:6'
        ];
        return Validator::make($data, $rules);
    }

    public function change_password(Request $request) {
        $validator = $this->validator_password($request->only(
            'password', 'password_confirmation'
        ));
        if ( $validator->passes() ) {          
            $this->updatePassword(Auth::user(), $request->get('password'));
            $message = trans('app.updated_password');

             if ( $request->ajax() ) {

                return response()->json([
                    'success' => true,
                    'message' => $message
                ]);
            } 

            return back()->withSuccess($message);

        } else {

            $messages = $validator->errors()->getMessages();

            if ( $request->ajax() ) {

                return response()->json([
                    'success' => false,
                    'validator' => true,
                    'message' => $messages
                ]);
            } 

            return back()->withErrors($messages);         
        }  
    }

    /**
     * Change the given user's password.
     *
     * @param  \Illuminate\Contracts\Auth\CanResetPassword  $user
     * @param  string  $password
     * @return void
     */
    protected function updatePassword($user, $password)
    {
        $user->password = $password;
        $user->save();
    }

    /**
     * form setting of user
     *
     */
    public function setting() {

        $user = Auth::user();
        $languages = [
            'es' => trans('app.spanish'),
            'en' => trans('app.english')
        ]; 

        return view('users.setting', compact('user', 'languages', 'locations_labels'));
    }

    /**
     * Update setting of user
     *
     */
    protected function update_setting(Request $request)
    {
        $user = $this->users->update(Auth::user()->id, $request->all());

        if($user) {
            Config::set('app.locale', $request->get('lang'));
            App::setLocale($request->get('lang'));
            Session::put('locale', $request->get('lang'));

            return back()->withSuccess(trans('app.settings_updated'));
        } else {

            return back()->withErrors(trans('app.error_again'));
        }

    }

}
