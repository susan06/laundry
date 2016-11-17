<?php

namespace App\Http\Controllers\Auth;

use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Repositories\User\UserRepository;
use App\Support\User\UserStatus;

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
        $this->middleware('guest', ['except' => 'logout']);
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
    public function authenticate(Request $request)
    {
        $credentials = ['email' => $request->get('email'), 'password' => $request->get('password')];

        if (Auth::attempt($credentials)) {

            $user = Auth::getProvider()->retrieveByCredentials($credentials);

            if ($user->isUnconfirmed()) {
                return redirect()->to('login')->withErrors(trans('app.please_confirm_your_email_first'));
            }
            
            if ($user->isBanned()) {
                return redirect()->to('login')->withErrors(trans('app.your_account_is_banned'));
            }

            Auth::login($user, true);

            $this->users->update($user->id, ['last_login' => Carbon::now()]);

            return redirect()->intended('home');

        }
    }

    /**
     * Log the user out of the application.
     *
     * @return \Illuminate\Http\Response
     */
    public function getLogout()
    {
        $role = Auth::user()->role_id;

        Auth::logout();

        if ($role == 2) {
            return redirect('login');
        }

        return redirect('panel');
    }

}
