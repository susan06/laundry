<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use App\User;
use App\Http\Requests;
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

class ClientController extends Controller
{
    /**
     * @var ClientRepository
     */
    private $clients;

    /**
     * UserController constructor.
     * @param UserRepository $roles
     */
    public function __construct(ClientRepository $clients, UserRepository $users)
    {
        $this->middleware('auth');
        $this->clients = $clients;
        $this->users = $users;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $clients = $this->clients->paginate_search(10, $request->search);
        if ( $request->ajax() ) {
            if (count($clients)) {
                return response()->json([
                    'success' => true,
                    'view' => view('users.clients.list', compact('clients'))->render(),
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
        //return view('clients.create');
        $edit = false;
        $role = ($request->role == 'true') ? true : false;
        $status = ['' => trans('app.selected_item')] + UserStatus::lists();
        $roles = ['' => trans('app.selected_item')] + $roleRepository->lists('display_name');

        return response()->json([
            'success' => true,
            'view' => view('users.clients.create-edit', compact('edit','status','roles', 'role'))->render()
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
            'name' => $request->first_name,
            'lastname' => $request->last_name,
            'email' => $request->email,
            'role_id' => $request->role_id,
            'status' => $request->status,
            'password' => bcrypt(str_random(6))
        ];
        $user = $this->users->create($dataUser);

        $dataClient = [
            'user_id' => $user->id,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => bcrypt(str_random(6))
        ];
        $client = $this->clients->create($dataClient);

        if ( $client ) {

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
    public function edit()
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update()
    {
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {      
        
    }
    

    /**
     * Show the form for request services.
     *
     * @return \Illuminate\Http\Response
     */
    public function requestServices()
    {
        return view('clients.services');
    }

    /**
     * Show the list of orders.
     *
     * @return \Illuminate\Http\Response
     */
    public function myOrders()
    {
        return view('clients.orders');
    }

    /**
     * Show the client´s profile.
     *
     * @return \Illuminate\Http\Response
     */
    public function myProfile()
    {
        return view('clients.profile');
    }

    /**
     * Show the terms and conditions.
     *
     * @return \Illuminate\Http\Response
     */
    public function termsAndConditions()
    {
        return view('clients.terms');
    }

    /**
     * Show the frequent questions.
     *
     * @return \Illuminate\Http\Response
     */
    public function frequentQuestions()
    {
        return view('clients.questions');
    }

    /**
     * Show the privacy policies.
     *
     * @return \Illuminate\Http\Response
     */
    public function privacyPolicies()
    {
        return view('clients.privacy');
    }

    /**
     * Show the form for invite friend.
     *
     * @return \Illuminate\Http\Response
     */
    public function inviteFriend()
    {
        return view('clients.invite');
    }
}
