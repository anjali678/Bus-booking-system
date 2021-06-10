<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RouteRequest;
use App\Models\Route;

class RouteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // All Routes
        $route = Route::all();
        // Return Json Response
       return response()->json([
          'routes' => $route
       ],200);
    }

    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RouteRequest $request)
    {
        $input = $request->all();

        // Will return only validated data
        $validated = $request->validated();

        $route = Route::create($input);
        // Return Json Response
        return response()->json([
            'message' => "Route successfully created."
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
        // Route Detail 
        $route = Route::find($id);
        if(!$route){
            return response()->json([
               'message'=>'Route Not Found.'
            ],404);
        }

       // Return Json Response
        return response()->json([
           'route' => $route
        ],200);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RouteRequest $request, $id)
    {
        $input = $request->all();

        // Will return only validated data
        $validated = $request->validated();

        $route = Route::find($id);
        if(!$route){
          return response()->json([
             'message'=>'Route Not Found.'
          ],404);
        }
        $route->name = $input['name'];
        $route->type = $input['type'];
        $route->vehical_number = $input['vehical_number'];
        $route->save();
        
        // Return Json Response
        return response()->json([
            'message' => "Route successfully updated."
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
        // Route Detail 
        $route = Route::find($id);
        if(!$route){
          return response()->json([
             'message'=>'Route Not Found.'
          ],404);
        }

        // Delete route
        $route->delete();

        // Return Json Response
        return response()->json([
            'message' => "Route successfully deleted."
        ],200);
    }
}
