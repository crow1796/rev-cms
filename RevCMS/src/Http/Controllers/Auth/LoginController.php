<?php

namespace RevCMS\Http\Controllers\Auth;

use RevCMS\Http\Controllers\RevBaseController;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends RevBaseController
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
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/admin';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    public function showLoginForm(){
        return $this->makeView(
            'revcms.auth.login',
            'Login - ' . config('revcms.title')
            );
    }
}
