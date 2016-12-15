<?php

namespace App\Http\Controllers\Auth;

use Validator;
use Password;
use PasswordToken;
use App\Mailers\UserMailer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\User\UserRepository;

class ForgotPasswordController extends Controller
{

    /**
     * @var UserRepository
     */
    private $users;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(UserRepository $users)
    {
        $this->middleware('guest');
        $this->users = $users;
    }

    /**
     * Send a reset link to the given user.
     *
     * @param Request $request
     * @param UserMailer $mailer
     * @return \Illuminate\Http\Response
     */
    public function sendPasswordReminder(Request $request, UserMailer $mailer)
    {
        $validator = $this->validator_remind($request->only('email'));

        if ( $validator->passes() ) {

            $user = $this->users->findByEmail($request->get('email'));
            $token = app('auth.password.broker')->createToken($user);
            $mailer->sendPasswordReminder($user, $token, $request->get('admin'));

            if ( $request->ajax() ) {

                return response()->json([
                    'success' => true,
                    'message' => trans('app.password_reset_email_sent')
                ]);
            } 

            return back()->withSuccess(trans('app.password_reset_email_sent'));

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
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator_remind(array $data)
    {
        $rules = [
             'email' => 'required|email|exists:users,email',
        ];

        return Validator::make($data, $rules);
    }

}
