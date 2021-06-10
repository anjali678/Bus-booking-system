<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Super_admin;
Use Arr;

class SuperAdminController extends Controller
{
    /**
    * Login admin
    * @param Request $request
    * @return Super_admin $user with token
    */
    public function login(UserRequest $request)
    {
    	// Will return only validated data
        $validated = $request->validated();

        $password = Super_admin::where('email',$request->email)->value('password');
    	if($password!=$request->password){
            return response()->json([
                'status' => 401,
                'message' => "Unauthorised"
            ],401);
        }
        $user = Super_admin::where("email",$request->email)->select('id','name','email')->first();
        $token = $user->createToken('user-token')->plainTextToken;
        Arr::add($user,'token',$token);
        return response()->json($user); 
    }

    public function resetPassword(UserRequest $request,$id) {
        // Will return only validated data
        $validated = $request->validated();

        $user= Super_admin::find($id);
        if(!$user){
          return response()->json([
             'message'=>'user Not Found.'
          ],404);
        }
        if ($user->password==$request->old_password && $request->new_password==$request->confirm_password) {
            return response()->json(["msg" => "Password has been successfully changed"]);
        }
        $user->password = $request->new_password
        $user->save();

        return response()->json(["msg" => "wrong"]);
    }
}
