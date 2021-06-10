<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Bus_routeRequest;
use App\Models\Bus_route;

class Bus_routeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // All Bus_routes
        $bus_route = Bus_route::all();
        // Return Json Response
       return response()->json([
          'bus_routes' => $bus_route
       ],200);
    }

    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Bus_routeRequest $request)
    {
        $input = $request->all();

        // Will return only validated data
        $validated = $request->validated();

        $bus_route = Bus_route::create($input);
        // Return Json Response
        return response()->json([
            'message' => "Bus_route successfully created."
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
        // Bus_route Detail 
        $bus_route = Bus_route::find($id);
        if(!$bus_route){
            return response()->json([
               'message'=>'Bus_route Not Found.'
            ],404);
        }

       // Return Json Response
        return response()->json([
           'bus_route' => $bus_route
        ],200);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Bus_routeRequest $request, $id)
    {
        $input = $request->all();

        // Will return only validated data
        $validated = $request->validated();

        $bus_route = Bus_route::find($id);
        if(!$bus_route){
          return response()->json([
             'message'=>'Bus_route Not Found.'
          ],404);
        }
        $bus_route->bus_id = $input['bus_id'];
        $bus_route->route_id = $input['route_id'];
        $bus_route->status = $input['status'];
        $bus_route->save();
        
        // Return Json Response
        return response()->json([
            'message' => "Bus_route successfully updated."
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
        // Bus_route Detail 
        $bus_route = Bus_route::find($id);
        if(!$bus_route){
          return response()->json([
             'message'=>'Bus_route Not Found.'
          ],404);
        }

        // Delete Bus_route
        $bus_route->delete();

        // Return Json Response
        return response()->json([
            'message' => "Bus_route successfully deleted."
        ],200);
    }
}
