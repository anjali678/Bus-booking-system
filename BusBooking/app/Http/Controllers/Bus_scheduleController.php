<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Bus_scheduleRequest;
use App\Models\Bus_schedule;

class Bus_scheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // All Bus_schedule
        $bus_schedule = Bus_schedule::all();
        // Return Json Response
       return response()->json([
          'bus_schedules' => $bus_schedule
       ],200);
    }

    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Bus_scheduleRequest $request)
    {
        $input = $request->all();

        // Will return only validated data
        $validated = $request->validated();

        $bus_schedule = Bus_schedule::create($input);
        // Return Json Response
        return response()->json([
            'message' => "Bus_schedule successfully created."
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
        // Bus_schedule Detail 
        $bus_schedule = Bus_schedule::find($id);
        if(!$bus_schedule){
            return response()->json([
               'message'=>'Bus_schedule Not Found.'
            ],404);
        }

       // Return Json Response
        return response()->json([
           'bus_schedule' => $bus_schedule
        ],200);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Bus_scheduleRequest $request, $id)
    {
        $input = $request->all();

        // Will return only validated data
        $validated = $request->validated();

        $bus_schedule = Bus_schedule::find($id);
        if(!$bus_schedule){
          return response()->json([
             'message'=>'Bus_schedule Not Found.'
          ],404);
        }
        $bus_schedule->bus_route_id = $input['bus_route_id'];
        $bus_schedule->direction = $input['direction'];
        $bus_schedule->start_timestamp = $input['start_timestamp'];
        $bus_schedule->end_timestamp = $input['end_timestamp'];
        $bus_schedule->save();
        
        // Return Json Response
        return response()->json([
            'message' => "Bus_schedule successfully updated."
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
        // Bus_schedule Detail 
        $bus_schedule = Bus_schedule::find($id);
        if(!$bus_schedule){
          return response()->json([
             'message'=>'Bus_schedule Not Found.'
          ],404);
        }

        // Delete bus_schedule
        $bus_schedule->delete();

        // Return Json Response
        return response()->json([
            'message' => "Bus_schedule successfully deleted."
        ],200);
    }
}
