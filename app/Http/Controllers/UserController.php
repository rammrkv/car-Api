<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserDetails;
use Log;
use Illuminate\Support\Facades\Auth;
use Validator;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
    
class UserController extends Controller
{
	
	public function __construct()
    {
        //$this->middleware('auth');
    }
    
    /**
     * Store a new user.
     *
     * @param  Request  $request
     * @return Response
     */
    public function register(Request $request)
    {
		
		$validator = Validator::make($request->all(), [
            'fisrt_name' => 'required|string',
            'last_name' => 'required|string',
            'email_id' => 'required|email|unique:user_details',
            'password' => 'required|confirmed',
        ]);
        
        if ($validator->fails()) {
           return response()->json(['Status' => 'Failed','Msg' => $validator->messages()->first()], 200);
        }
        
        try {

            $user = new UserDetails;
            $user->fisrt_name = $request->input('fisrt_name');
            $user->last_name = $request->input('last_name');
            $user->email_id = $request->input('email_id');
            $plainPassword = $request->input('password');
            $user->password = app('hash')->make($plainPassword);
			$user->user_status = 'A';
			$user->created_at = date('Y-m-d H:i:s');
            $user->save();
            
            $token = JWTAuth::fromUser($user);

            //return successful response
            return response()->json(['Status' => 'Success','User' => $user, 'Msg' => 'User Created', 'token' => $token], 200);

        } catch (\Exception $e) {
            //return error message
            Log::info($e);
            return response()->json(['Status' => 'Failed','Msg' => 'User Registration Failed!'], 200);
        }

    }
    
    public function getCurrentUser()
    {
        return response()->json(['Status' => 'Success','User' => Auth::user()], 200);
    }
    
    public function getUser($userId)
    {
		try {
			
            $user = UserDetails::findOrFail($userId);

            return response()->json(['Status' => 'Success','User' => $user], 200);

        } catch (\Exception $e) {

            return response()->json(['Status' => 'Failed','Msg' => 'User not found!'], 200);
        }
    }


}
