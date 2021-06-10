<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
    use HasFactory;
    protected $fillable = [
        'node_one',
        'node_two',
        'route_number',
        'distance',
        'time'
    ];

    public function getsuper_adminRelation(){
    	return $this->belongsTo('App\Super_admin');
    }

    // public function getBusRelation(){
    // 	return $this->hasmany( related: 'App\Bus', table: 'bus_routes', foreignPivotKey: 'route_id', relatedPivotKey: 'bus_id');
    // }

    public function getBus_routeRelation(){
        return $this->hasmany('App\Bus_route', 'route_id', 'id');
    }

}
