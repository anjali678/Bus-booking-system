<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bus_schedule extends Model
{
    use HasFactory;
    protected $fillable = [
        'bus_route_id',
        'direction',
        'start_timestamp',
        'end_timestamp'
    ];

    public function getsuper_adminRelation(){
    	return $this->belongsTo('App\Super_admin');
    }

    public function getBus_routeRelation(){
        return $this->belongsTo('App\Bus_route', 'bus_route_id', 'id');
    }

    public function getBus_schedule_bookingRelation(){
        return $this->hasMany('App\Bus_schedule_booking', 'bus_schedule_id', 'id');
    }
    
}
