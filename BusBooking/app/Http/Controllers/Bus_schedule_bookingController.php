<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Bus_schedule_bookingRequest;
use App\Models\Bus_schedule_booking;

class Bus_schedule_bookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // All Bus_schedule_booking
        $bus_schedule_booking = Bus_schedule_booking::all();
        // Return Json Response
       return response()->json([
          'bus_schedule_bookings' => $bus_schedule_booking
       ],200);
    }

    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Bus_schedule_bookingRequest $request)
    {
        $input = $request->all();

        // Will return only validated data
        $validated = $request->validated();

        $bus_schedule_booking = Bus_schedule_booking::create($input);
        // Return Json Response
        return response()->json([
            'message' => "Bus booking successfully created."
        ],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Bus_schedule_booking Detail 
        $bus_booking = Bus_schedule_booking::find($id);
        if(!$bus_booking){
            return response()->json([
               'message'=>'Bus booking Not Found.'
            ],404);
        }

       // Return Json Response
        return response()->json([
           'bus_booking' => $bus_booking
        ],200);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Bus_schedule_bookingRequest $request, $id)
    {
        $input = $request->all();

        // Will return only validated data
        $validated = $request->validated();

        $bus_schedule_booking = Bus_schedule_booking::find($id);
        if(!$bus_schedule_booking){
          return response()->json([
             'message'=>'Bus booking Not Found.'
          ],404);
        }
        $bus_schedule_booking->bus_seate_id = $input['bus_seate_id'];
        $bus_schedule_booking->user_id = $input['user_id'];
        $bus_schedule_booking->bus_schedule_id = $input['bus_schedule_id'];
        $bus_schedule_booking->seat_number = $input['seat_number'];
        $bus_schedule_booking->price = $input['price'];
        $bus_schedule_booking->status = $input['status'];
        $bus_schedule_booking->save();
        
        // Return Json Response
        return response()->json([
            'message' => "Bus booking successfully updated."
        ],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Bus_schedule_booking Detail 
        $bus_schedule_booking = Bus_schedule_booking::find($id);
        if(!$bus_schedule_booking){
          return response()->json([
             'message'=>'Bus booking Not Found.'
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
