<?php

namespace App\Http\Controllers;

use Auth;
use Validator;
use Illuminate\Http\Request;
use App\Repositories\Qualification\QualificationRepository;

class QualificationController extends Controller
{
    /**
     * @var QualificationRepository
     */
    private $qualifications;

    /**
     * QualificationController constructor.
     * @param QualificationRepository $qualifications
     */
    public function __construct(QualificationRepository $qualifications)
    {
        $this->middleware('auth');
        $this->middleware('locale'); 
        $this->middleware('timezone'); 
        $this->qualifications = $qualifications;
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $rules = [
            'quantify' => 'required|numeric',
        ];

        return Validator::make($data, $rules);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $quantify = $this->qualifications->media_quantify();
        $qualifications = $this->qualifications->paginate(10);
        if ( $request->ajax() ) {
            if (count($qualifications)) {
                return response()->json([
                    'success' => true,
                    'view' => view('qualifications.list', compact('qualifications'))->render(),
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => trans('app.no_records_found')
                ]);
            }
        }

        return view('qualifications.index', compact('qualifications', 'quantify'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        $quantify = $user->qualification->quantify;

        if ( !$quantify ) {
            $quantify = 0;
        }

        return view('qualifications.create_edit', compact('quantify'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = $this->validator($request->only('quantify'));
         if ( $validator->passes() ) {
            $qualification = $this->qualifications->create_update($request->get('quantify'));

            if ( $request->ajax() ) {

                return response()->json([
                    'success' => true,
                    'message' => trans('app.qualification_saved')
                ]);
            } 

            return back()->withSuccess(trans('app.qualification_saved'));

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
}
