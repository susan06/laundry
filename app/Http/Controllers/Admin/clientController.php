<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Validator;
use Auth;
use App\User;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\User\UserRepository;
use App\Support\User\UserStatus;
use App\Repositories\Client\ClientRepository;

class ClientController extends Controller
{
    /**
     * @var UserRepository
     */
    private $users;

    /**
     * UserController constructor.
     * @param UserRepository $roles
     */
    public function __construct(UserRepository $users, ClientRepository $clients)
    {
        $this->middleware('auth');
        $this->middleware('locale'); 
        $this->middleware('timezone'); 
        $this->users = $users;
        $this->clients= $clients;
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
            'phone_mobile' => 'required|numeric'
        ];

        if ($id) {
            $rules['email'] = 'required|email|unique:users,email,'.$id;
            $rules['status'] = 'required';
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
        $clients = $this->users->client_paginate_search(10, $request->search, $request->status);
        $status = ['' => trans('app.all_status')] + UserStatus::lists();
        $all_clients = $this->users->where('role_id', 2)->get();
        if ( $request->ajax() ) {
            if (count($drivers)) {
                return response()->json([
                    'success' => true,
                    'view' => view('users.clients.list', compact('clients', 'status', 'all_clients'))->render(),
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => trans('app.no_records_found')
                ]);
            }
        }

        return view('users.clients.index', compact('clients', 'status', 'all_clients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $edit = false;

        return response()->json([
            'success' => true,
            'view' => view('users.clients.create-edit', compact('edit'))->render()
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
                'lastname' => $request->lastname,
                'email' => $request->email,
                'role_id' => 2,
                'phones' => '{"phone_mobile":"'.$request->phone_mobile.'","phone_home":"'.$request->phone_home.'"}',
                'birthday' => $request->birthday,
                'password' => 'secret',
                'status' => UserStatus::ACTIVE
            ];
            $user = $this->users->create($data);

            if ( $user ) {

                return response()->json([
                    'success' => true,
                    'message' => trans('app.client_created_defaut_pass')
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
    public function show($id, Request $request)
    {
        if ( $user = $this->users->find($id) ) {
            $phones_array = json_decode($user->phones, true);
            $phones['phone_mobile'] = isset($phones_array['phone_mobile']) ?  $phones_array['phone_mobile'] : null;
            $phones['phone_home'] = isset($phones_array['phone_home']) ?  $phones_array['phone_home'] : null;
            $status = UserStatus::lists();
            return response()->json([
                'success' => true,
                'view' => view('users.clients.show', compact('user','status', 'phones'))->render()
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
    public function edit($id, Request $request)
    {
        $edit = true;
        $status = UserStatus::lists();
        if ( $user = $this->users->find($id) ) {
            $phones_array = json_decode($user->phones, true);
            $phones['phone_mobile'] = isset($phones_array['phone_mobile']) ?  $phones_array['phone_mobile'] : null;
            $phones['phone_home'] = isset($phones_array['phone_home']) ?  $phones_array['phone_home'] : null;
            return response()->json([
                'success' => true,
                'view' => view('users.clients.create-edit', compact('user','edit','status','phones'))->render()
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
                'birthday' => $request->birthday,
                'status' => $request->status
            ];

            $user = $this->users->update($id, $data);
            if ( $user ) {

                return response()->json([
                    'success' => true,
                    'message' => trans('app.client_updated')
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
        if ( $this->users->delete($id) ) {
            return response()->json([
                'success' => true,
                'message' => trans('app.deleted_client')
            ]);
        } else {
            return response()->json([
                'success'=> false,
                'message' => trans('app.error_again')
            ]);
        } 
    }

    /**
     * Display a listing of friends invited.
     *
     * @return \Illuminate\Http\Response
     */
    public function friends(Request $request, ClientRepository $clientRepository)
    {
        $friends = $clientRepository->paginate_friends(10);
        if ( $request->ajax() ) {
            if (count($drivers)) {
                return response()->json([
                    'success' => true,
                    'view' => view('users.clients.list_friends', compact('friends'))->render(),
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => trans('app.no_records_found')
                ]);
            }
        }

        return view('users.clients.index_friends', compact('friends'));
    }

    /**
     * Display map of locations clients
     *
     * @return \Illuminate\Http\Response
     */
    public function locations()
    {
        return response()->json([
            'success' => true,
            'view' => view('users.clients.map')->render()
        ]);
    }
    

    public function editStatusLocations($client, Request $request) 
    {
        $message = false;
        $client = $this->users->find($client);
        $locations_status = [
            'rejected' => trans("app.rejected"), 
            'on_hold' => trans("app.on_hold"), 
            'accepted' => trans("app.accepted")
        ];
        if( isset($request->id) && isset($request->status) ) {
            $addresss = $this->clients->update_location($request->id,[
                'status' => $request->status,
                'reazon_status' => $request->reazon_status
            ]);
            $message = trans('app.location_updated');
        }
        if ( $request->ajax() ) {
            return response()->json([
                'success' => true,
                'message' => $message,
                'view' => view('users.clients.list_locations', compact('client', 'locations_status'))->render(),
            ]);
        }

        return view('users.clients.locations', compact('client', 'locations_status'));
    }
    
}
