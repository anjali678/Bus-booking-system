<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bus_route extends Model
{
    use HasFactory;
    protected $fillable = [
        'bus_id',
        'route_id',
        'status',
    ];

    public function getsuper_adminRelation(){
    	return $this->belongsTo('App\Super_admin');
    }

    public function getRouteRelation(){
    	return $this->belongsTo('App\Route', 'route_id', 'id');
    }

    public function getBusRelation(){
    	return $this->belongsTo('App\Bus', 'bus_id', 'id');
    }

    public function getBus_scheduleRelation(){
    	return $this->hasmany('App\Bus_schedule', 'bus_route_id', 'id');
    }
    
}
