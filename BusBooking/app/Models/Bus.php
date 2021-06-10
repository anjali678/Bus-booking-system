<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bus extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'type',
        'vehical_number',
    ];

    public function getsuper_adminRelation(){
    	return $this->belongsTo('App\Super_admin');
    }

    // public function getRouteRelation(){
    // 	return $this->belongsTo( related: 'App\Route', table: 'bus_routes', foreignPivotKey: 'bus_id', relatedPivotKey: 'route_id');
    // }

    public function getBus_seateRelation(){
    	return $this->hasmany('App\Bus_seate', 'bus_id', 'id');
    }

    public function getBus_routeRelation(){
        return $this->hasOne( 'App\Bus_route', 'bus_id', 'id');
    }
    
}
