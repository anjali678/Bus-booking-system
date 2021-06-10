<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bus_seate extends Model
{
    use HasFactory;
    protected $fillable = [
        'bus_id',
        'seat_number',
        'price',
    ];

    public function getsuper_adminRelation(){
    	return $this->belongsTo('App\Super_admin');
    }

    public function getBusRelation(){
    	return $this->belongsTo('App\Bus', 'bus_id', 'id');
    }

    public function getBus_schedule_bookingRelation(){
        return $this->hasOne('App\Bus_schedule_booking', 'bus_seate_id', 'id');
    }
    
}
