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

        $user = User::find($id);
       
        if ($request->new_password==$request->confirm_password) {
            $user->password = Hash::make($request->new_password);
            $user->setRememberToken(Str::random(60));
            $user->save();
            event(new PasswordReset($user));
            $this->guard()->login($user);
            return response()->json(["msg" => "Password has been successfully changed"]);
        }else{
        return response()->json(["msg" => "wrong"]);}
    }


    /**Check bus schedule list**/
    public function bus_schedule_list(){
        // All Bus schedules
        $bus = Bus_schedule::all();
    
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


    /**cancel bookings before 10hrs**/
    public function cancel_bookings($id){
        // Bus_schedule_booking Detail 
        $bus_schedule_booking = Bus_schedule_booking::find($id);
        $start = time('H:i:s');
        $current_time = time('H:i:s',strtotime('+10 hour',strtotime($start)));
        if($bus_schedule_booking->start_timestamp==$current_time){
          return response()->json([
             'message'=>'can not delete.'
          ],404);
        }

        // Delete Bus_schedule_booking
        $bus_schedule_booking->delete();

        // Return Json Response
        return response()->json([
            'message' => "Bus booking successfully deleted."
        ],200);
    }

}
