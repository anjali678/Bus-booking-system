<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\BusRequest;
use App\Models\Bus;
use App\Http\Resources\Bus as BusResource;

class BusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // All Buses
        $bus = Bus::all();
        // Return Json Response
       return response()->json([
          'buses' => $bus
       ],200);
    }

    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BusRequest $request)
    {
        $input = $request->all();

        // Will return only validated data
        $validated = $request->validated();

        $bus = Bus::create($input);
        // Return Json Response
        return response()->json([
            'message' => "Bus successfully created."
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
        // Bus Detail 
        $bus = Bus::find($id);
        if(!$bus){
            return response()->json([
               'message'=>'Bus Not Found.'
            ],404);
        }

       // Return Json Response
        return response()->json([
           'bus' => $bus
        ],200);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BusRequest $request, $id)
    {
        $input = $request->all();

        // Will return only validated data
        $validated = $request->validated();

        $bus = Bus::find($id);
        if(!$bus){
          return response()->json([
             'message'=>'Bus Not Found.'
          ],404);
        }
        $bus->name = $input['name'];
        $bus->type = $input['type'];
        $bus->vehical_number = $input['vehical_number'];
        $bus->save();
        
        // Return Json Response
        return response()->json([
            'message' => "Bus successfully updated."
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
        // Bus Detail 
        $bus = Bus::find($id);
        if(!$bus){
          return response()->json([
             'message'=>'Bus Not Found.'
          ],404);
        }

        // Delete bus
        $bus->delete();

        // Return Json Response
        return response()->json([
            'message' => "bus successfully deleted."
        ],200);
    }
}
