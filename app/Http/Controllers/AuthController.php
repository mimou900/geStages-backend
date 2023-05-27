<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful;

use App\Models\User;
use GuzzleHttp\Psr7\Message;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{
    public function register(Request $request){
        $fields = $request->validate([
            'name'=>'required|string',
            'email'=>'required|string|unique:users,email',
            'password' => 'required|string'
        ]);
        $user = User::create([
            'name' =>$fields['name'],
            'email' =>$fields['email'],
            'password' =>bcrypt($fields['password']) 
        ]);
        $token = $user->createToken('myapptoken')->plainTextToken;

        $response =[
            'user'=>$user,
            'token'=>$token
        ];
        return response($response ,201);
    }


    



    public function login(Request $request){
        $fields = $request->validate([
            'email'=>'required|string',
            'password' => 'required|string'
        ]);
        //check email 
        $user = User::where('email',$fields['email'])->first();


        //check password
        if( !$user || !Hash::check($fields['password'],$user->password)){
            return response([
                'message' =>'Bad creds'
            ],401);
        }
        $token = $user->createToken('myapptoken')->plainTextToken;
        $cookie = cookie(name:'jwt', value: $token, minutes:60 * 24);
        $response =[
            'user'=>$user,
            'token'=>$token
        ];
        return response($response ,201);
       
    }


    public function logout()
{
    Auth::logout();
    return response([
        'message' => 'logout'
    ]);
}



public function __invoke()
    {
        request()->validate([
            'email' => ['required', 'string', 'email'],
            'password' => ['required'],
        ]);

        /**
         * We are authenticating a request from our frontend.
         */
        if (EnsureFrontendRequestsAreStateful::fromFrontend(request())) {
            $this->authenticateFrontend();
        }
        /**
         * We are authenticating a request from a 3rd party.
         */
        else {
            // Use token authentication.
        }
    }

    private function authenticateFrontend()
    {
        if (! Auth::guard('web')
            ->attempt(
                request()->only('email', 'password'),
                request()->boolean('remember')
            )) {
            throw ValidationException::withMessages([
                'email' => __('auth.failed'),
            ]);
        }
    }


}
