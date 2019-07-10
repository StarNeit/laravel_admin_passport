<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Lcobucci\JWT\Parser;
use App\User;
use phpDocumentor\Reflection\Types\Void_;

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
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request){
        $user = User::where('name',$request->name)->first();

        if( $user ){
            if( $request->password == $user->password ){
                $token = $user->createToken('Laravel Password Grant Client')->accessToken;
                $response = ['token'=>$token];
                $request->session()->put('username', $user->name);
                $request->session()->put('role', $user->role);
                return response($response, 200 );
            }else{
                $response = 'Password mismatch';
                return response($response, 422);
            }
        }else{
            $response = 'User doesn\'t exists';
            return response($response,422);
        }
    }

    public function logout(Request $request){
        $value = $request->bearerToken();
        $id = ( new Parser())->parse($value)->getHeader('jti');
        $token = $request->user()->tokens->find($id);
        $token->revoke();
        $request->session()->flush();
        $response = 'You have been Successfully logged out!';
        return response($response,200);
    }
}
