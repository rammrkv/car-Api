<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Log;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    
    
	/**
     * Get a JWT via given credentials.
     *
     * @param  Request  $request
     * @return Response
     */
    public function login(Request $request)
    {
          //validate incoming request 
        $this->validate($request, [
            'email_id' => 'required|string',
            'password' => 'required|string',
        ]);

        //$credentials = $request->only(['email_id', 'password']);
        $credentials = ['email_id'=>$request->input('email_id'),'password'=>$request->input('password'), 'user_status'=> 'A' ];

        if (! $token = Auth::attempt($credentials)) {
             return response()->json(['Status' => 'Failed','Msg' => 'Unauthorized Access'], 401);
        }

        return $this->respondWithToken($token);
    }

}
