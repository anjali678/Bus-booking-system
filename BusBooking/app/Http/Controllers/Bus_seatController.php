<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\Bus_seatRequest;
use App\Models\Bus_seate;

class Bus_seatController extends Controller
{
	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // All Bus_seats
        $bus_seat = Bus_seate::all();
        // Return Json Response
       return response()->json([
          'bus_seats' => $bus_seat
       ],200);
    }

    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Bus_seatRequest $request)
    {
        $input = $request->all();

        // Will return only validated data
        $validated = $request->validated();

        $bus_seat = Bus_seate::create($input);
        // Return Json Response
        return response()->json([
            'message' => "Bus seat successfully created."
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
        // Bus_seat Detail 
        $bus_seat = Bus_seate::find($id);
        if(!$bus_seat){
            return response()->json([
               'message'=>'Bus seat Not Found.'
            ],404);
        }

       // Return Json Response
        return response()->json([
           'bus_seat' => $bus_seat
        ],200);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Bus_seatRequest $request, $id)
    {
        $input = $request->all();

        // Will return only validated data
        $validated = $request->validated();

        $bus_seat = Bus_seate::find($id);
        if(!$bus_seat){
          return response()->json([
             'message'=>'Bus_seat Not Found.'
          ],404);
        }
        $bus_seat->bus_id = $input['bus_id'];
        $bus_seat->seat_number = $input['seat_number'];
        $bus_seat->price = $input['price'];
        $bus_seat->save();
        
        // Return Json Response
        return response()->json([
            'message' => "Bus seat successfully updated."
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
        // Bus_seat Detail 
        $bus_seat = Bus_seate::find($id);
        if(!$bus_seat){
          return response()->json([
             'message'=>'Bus_seat Not Found.'
          ],404);
        }

        // Delete bus_seat
        $bus_seat->delete();

        // Return Json Response
        return response()->json([
            'message' => "Bus_seat successfully deleted."
        ],200);
    }
}
