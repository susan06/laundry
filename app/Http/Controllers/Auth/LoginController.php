<?php

namespace App\Http\Controllers\Auth;

use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Repositories\User\UserRepository;
use App\Support\User\UserStatus;
use App\Http\Requests\Auth\LoginRequest;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * @var UserRepository
     */
    private $users;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(UserRepository $users)
    {
        $this->middleware('guest', ['except' => 'getLogout']);
        $this->users = $users;
    }

     /**
     * Show login form panel.
     *
     * @return \Illuminate\Http\Response
     */
    public function getPanel()
    {
        return view('auth.login_panel');
    }

     /**
     * Handle an authentication attempt.
     *
     * @return Response
     */
    public function authenticate(LoginRequest $request)
    {
        $credentials = ['email' => $request->get('email'), 'password' => $request->get('password')];

        if (Auth::attempt($credentials)) {

            $user = Auth::getProvider()->retrieveByCredentials($credentials);
            
            if ($user->isUnconfirmed()) {
                Auth::logout();
                return redirect()->to('login')->withErrors(trans('app.please_confirm_your_email_first'));
            }
            
            if ($user->isBanned()) {
                Auth::logout();
                return redirect()->to('login')->withErrors(trans('app.your_account_is_banned'));
            }

            Auth::login($user, true);

            $this->users->update($user->id, ['last_login' => Carbon::now()]);

            return redirect()->intended('home');

        } else {

            return redirect()->back()->withErrors(trans('auth.failed'));
        }
    }

    /**
     * Confirm user's email.
     *
     * @param $token
     * @return \Illuminate\Http\Route
     */
    public function confirmEmail($token)
    {
        if ($user = $this->users->findByConfirmationToken($token)) {
            $this->users->update($user->id, [
                'status' => UserStatus::ACTIVE,
                'confirmation_token' => null
            ]);

            return redirect()->to('login')
                ->withSuccess(trans('app.email_confirmed_can_login'));
        }

        return redirect()->to('login')
            ->withErrors(trans('app.wrong_confirmation_token'));
    }

    /**
     * Log the user out of the application.
     *
     * @return \Illuminate\Http\Response
     */
    public function getLogout(Request $request)
    {
        $role = null;
        if ( Auth::guard()->check() ) {
            $role = Auth::user()->role_id;
            Auth::guard()->logout();
        }
        $request->session()->flush();
        $request->session()->regenerate();
        if ( !$role ) {

            return redirect('login');
        }
        if ($role == 2) {

            return redirect('login');
        }

        return redirect('panel');
    }

}
