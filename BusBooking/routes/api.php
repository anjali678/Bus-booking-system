<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\BusController;
use App\Http\Controllers\RouteController;
use App\Http\Controllers\Bus_seatController;
use App\Http\Controllers\Bus_scheduleController;
use App\Http\Controllers\Bus_routeController;
use App\Http\Controllers\Bus_schedule_bookingController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/************************************User Functionalities***************************************************/
Route::post("/register",[UserController::class,'register']); //User registration
Route::post("/login",[UserController::class,'login']); //User Login

Route::group(['middleware'=>['auth:sanctum']],function(){
	Route::get("/user",[UserController::class,'getUser']);  //get User
	Route::post("/logout",[UserController::class,'logout']);  //User logout
});
Route::put("resetPassword/{id}",[UserController::class,'resetPassword']);  //reset password


Route::get("/bus_schedule_list",[UserController::class,'bus_schedule_list']);  //get bus schedule list
Route::get("/get_my_bookings/{user_id}",[UserController::class,'my_bookings']);  //get my bookings
Route::delete("/cancel_bookings/{id}",[UserController::class,'cancel_bookings']);  //cancel my bookings



/*********book schedule************/
Route::get("/bus_schedule_booking_index",[Bus_schedule_bookingController::class,'index']);
Route::post('/bus_schedule_booking_store', [Bus_schedule_bookingController::class,'store']); // Create Bus_schedule_booking 
Route::get('bus_schedule_booking_show/{id}', [Bus_schedule_bookingController::class,'show']); // Detail of Bus_schedule_booking
Route::put('bus_schedule_booking_update/{id}', [Bus_schedule_bookingController::class,'update']); // Update Bus_schedule_booking
Route::delete('bus_schedule_booking_destroy/{id}', [Bus_schedule_bookingController::class,'destroy']); // Delete Bus_schedule_booking


/************************************Super Admin Functionalities***************************************************/
Route::post("/adminLogin",[SuperAdminController::class,'login']); //admin login


/*********Bus Management************/
Route::get("/bus_index",[BusController::class,'index']);
Route::post('/bus_store', [BusController::class,'store']); // Create bus 
Route::get('bus_show/{id}', [BusController::class,'show']); // Detail of Bus
Route::put('bus_update/{id}', [BusController::class,'update']); // Update bus
Route::delete('bus_destroy/{id}', [BusController::class,'destroy']); // Delete bus


/*********Route Management************/
Route::get("/route_index",[RouteController::class,'index']);
Route::post('/route_store', [RouteController::class,'store']); // Create route 
Route::get('route_show/{id}', [RouteController::class,'show']); // Detail of route
Route::put('route_update/{id}', [RouteController::class,'update']); // Update route
Route::delete('route_destroy/{id}', [RouteController::class,'destroy']); // Delete route


/*********route bus mapping************/
Route::get("/bus_route_index",[Bus_routeController::class,'index']);
Route::post('/bus_route_store', [Bus_routeController::class,'store']); // Create bus_route 
Route::get('bus_route_show/{id}', [Bus_routeController::class,'show']); // Detail of bus_route
Route::put('bus_route_update/{id}', [Bus_routeController::class,'update']); // Update bus_route
Route::delete('bus_route_destroy/{id}', [Bus_routeController::class,'destroy']); // Delete bus_route


/*********Bus_seat Management************/
Route::get("/bus_seat_index",[Bus_seatController::class,'index']);
Route::post('/bus_seat_store', [Bus_seatController::class,'store']); // Create bus_seat 
Route::get('bus_seat_show/{id}', [Bus_seatController::class,'show']); // Detail of bus_seat
Route::put('bus_seat_update/{id}', [Bus_seatController::class,'update']); // Update bus_seat
Route::delete('bus_seat_destroy/{id}', [Bus_seatController::class,'destroy']); // Delete bus_seat


/*********Bus_schedule Management************/
Route::get("/bus_schedule_index",[Bus_scheduleController::class,'index']);
Route::post('/bus_schedule_store', [Bus_scheduleController::class,'store']); // Create bus_schedule 
Route::get('bus_schedule_show/{id}', [Bus_scheduleController::class,'show']); // Detail of bus_schedule
Route::put('bus_schedule_update/{id}', [Bus_scheduleController::class,'update']); // Update bus_schedule
Route::delete('bus_schedule_destroy/{id}', [Bus_scheduleController::class,'destroy']); // Delete bus_schedule

