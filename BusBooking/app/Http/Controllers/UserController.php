<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Bus_schedule;
use App\Models\Bus_route;
use App\Models\Bus_schedule_booking;
use Validator;
use Arr;

class UserController extends Controller
{
    /**
    * Login user
    * @param Request $request
    * @return User $user with token
    */
    public function login(UserRequest $request)
    {
    	// Will return only validated data
        $validated = $request->validated();

    	if(!Auth::attempt($request->only('email','password'))){
            return response()->json([
                'status' => 401,
                'message' => "Unauthorised"
            ],401);
        }
        $user = User::where("email",$request->email)->select('id','name','email')->first();
        $token = $user->createToken('user-token')->plainTextToken;
        Arr::add($user,'token',$token);
        return response()->json($user); 
    }

    /**
    * Register user
    * @param Request $request
    * @return Bolean $result
    */
    public function register(UserRequest $request)
    {
    	// Will return only validated data
        $validated = $request->validated();

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        return response()->json([
            'message' => "registered"
        ]);
    }

     /**
    * Get User by the token
    * @param Request $request
    * @return User $user
    */
    public function getUser(Request $request){
        return response()->json(['user'=>$request->user()]);
    }

    /**
    * Get User by the token
    * @param Request $request
    * @return boolen $result
    */
    public function logout(Request $request){
        $request->user()->currentAccessToken()->delete();
        return response()->json([
            'status' => 200,
            'message' => "User logout"
        ],200);
    }

    /*****reset password*****/
    public function resetPassword(UserRequest $request,$id) {
        // Will return only validated data
        $validated = $request->validated();

        $user= User::find($id);
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


    /**Check bus schedule list**/
    public function bus_schedule_list(){
        // All Bus schedules
        $bus = Bus_schedule::with('getBus_routeRelation','getBus_routeRelation.getRouteRelation','getBus_routeRelation.getBusRelation')->select('direction','start_timestamp','end_timestamp');
        dd($bus);
        // Return Json Response
       return response()->json([
          'buses' => $bus
       ],200);
    }

    /**Check my bookings**/
    public function my_bookings($user_id){
        // All Bus schedules
        $bookings = Bus_schedule_booking::where("user_id",$user_id)->get();
        // Return Json Response
       return response()->json([
          'bookings' => $bookings
       ],200);
    }
}
