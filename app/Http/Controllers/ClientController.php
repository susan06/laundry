<?php

namespace App\Http\Controllers;

use Auth;
use Config;
use App;
use Session;
use Validator;
use Illuminate\Http\Request;
use App\Repositories\Client\ClientRepository;

class ClientController extends Controller
{
    /**
     * @var ClientRepository
     */
    private $clients;

    /**
     * ClientController constructor.
     */
    public function __construct(ClientRepository $clients)
    {
        $this->middleware('auth');
        $this->middleware('locale'); 
        $this->middleware('timezone'); 
        $this->clients = $clients;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('clients.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
 
    /**
     * form setting 
     *
     */
    public function setting() {

        $user = Auth::user();
        $languages = [
            'es' => trans('app.spanish'),
            'en' => trans('app.english')
        ]; 

        $locations_label = $this->clients->lists_locations_labels(Auth::user()->id);

        return view('clients.setting', compact('user', 'languages', 'locations_label'));
    }

    /**
     * Update setting of user
     *
     */
    protected function update_setting(Request $request)
    {
        $client = $this->clients->update(Auth::user()->id, $request->only('lang'));
        $locations_label = $request->location_label;
        foreach( $locations_label as $key => $value ) {
            $locations[$key+1] = $value;
        }
        if($client) {
            $location = $this->clients->update_locations_label(
                Auth::user()->id, 
                ['locations_labels' => json_encode($locations)]
            );
            Config::set('app.locale', $request->get('lang'));
            App::setLocale($request->get('lang'));
            Session::put('locale', $request->get('lang'));

            return back()->withSuccess(trans('app.settings_updated'));
        } else {

            return back()->withErrors(trans('app.error_again'));
        }

    }

    /**
     * Show the form for invite friend.
     *
     * @return \Illuminate\Http\Response
     */
    public function friends()
    {
        return view('clients.friends');
    }

    /**
     * store invitations of friends
     *
     * @return \Illuminate\Http\Response
     */
    public function friends_store(Request $request)
    {
        $friends = $request->friends;
        $friends = explode(',',$friends);

        foreach ($friends as $key => $value) {
            $validator = $this->validator_friend(['email' => $value]);
            if ( $validator->passes() ) {
                $friend = $this->clients->create_friend([
                    'user_id' => Auth::user()->id,
                    'email' => $value
                ]);
                if ( $request->ajax() ) {

                    return response()->json([
                        'success' => true,
                        'url_return' => route('client.friends'),
                        'message' => trans('invitations_sended')
                    ]);
                } 

                return back()->withSuccess(trans('invitations_sended'));

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
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator_friend(array $data)
    {
        $rules = [
            'email' => 'required|email|max:255|unique:client_friends'
        ];

        return Validator::make($data, $rules);
    }

    /**
     * locations
     *
     */
    protected function locations(Request $request)
    {
        $user = Auth::user();
        $count = 1;
        $locations_labels = $this->clients->lists_locations_labels(Auth::user()->id);

        return view('clients.locations', compact('user', 'count', 'locations_labels'));
    }

    /**
     * Update locations
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateLocations(Request $request)
    {
        $rules = [
            'locations_labels' => 'required',
            'address' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ( $validator->passes() ) {
            $client_id = Auth::user()->id;
            $locations = $request->address;
            $lat = $request->lat;
            $lng = $request->lng;
            $description = $request->description;
            $labels = $request->locations_labels;
            $location_id = $request->location_id;
            if ( $locations ) {
                $locations_old = Auth::user()->client_location->toArray();
                foreach( $locations as $key => $value ) {
                    if((int)$location_id[$key] == 0) {
                        if($value) {
                            $this->clients->create_location([ 
                                'client_id' => $client_id,
                                'label' => $labels[$key],
                                'address' => $value,           
                                'lat' => $lat[$key],
                                'lng' => $lng[$key],
                                'description' => $description[$key]
                                ]
                            );
                        }
                    } else {
                        foreach ($locations_old as $loc_old) {
                            if ( in_array($loc_old['id'], $location_id) ) {
                                if($value) {
                                    $this->clients->update_location(
                                        (int)$location_id[$key],[ 
                                        'label' => $labels[$key],
                                        'address' => $value,           
                                        'lat' => $lat[$key],
                                        'lng' => $lng[$key],
                                        'description' => $description[$key]
                                    ]);
                                }
                           } else {
                                $this->clients->delete_location($loc_old['id']);
                           }
                        }
                    }      
                }
            }

            return response()->json([
                'success' => true,
                'message' => trans('app.client_location_updated'),
                'url_return' => route('client.locations')
            ]);

        } else {
            $messages = $validator->errors()->getMessages();

            return response()->json([
                'success' => false,
                'validator' => true,
                'message' => $messages
            ]);
        }
    }
}
