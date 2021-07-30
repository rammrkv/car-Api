<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Log;
use Illuminate\Support\Facades\Auth;
use Validator;

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
		$validator = Validator::make($request->all(), [
            'email_id' => 'required|string',
            'password' => 'required|string'
        ]);
        
        if ($validator->fails()) {
           return response()->json(['Status' => 'Failed','Msg' => $validator->messages()->first()], 200);
        }
        
        //$credentials = $request->only(['email_id', 'password']);
        $credentials = ['email_id'=>$request->input('email_id'),'password'=>$request->input('password'), 'user_status'=> 'A' ];

        if (! $token = Auth::attempt($credentials)) {
             return response()->json(['Status' => 'Failed','Msg' => 'Authentication Failed'], 200);
        }

        return $this->respondWithToken($token);
    }

}
