<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bus_schedule_booking extends Model
{
    use HasFactory;
    protected $fillable = [
        'bus_seate_id',
        'user_id',
        'bus_schedule_id',
        'seat_number',
        'price',
        'status'
    ];

    public function getUserRelation(){
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function getBus_seateRelation(){
        return $this->belongsTo('App\Bus_seate', 'bus_seate_id', 'id');
    }

    public function getBus_scheduleRelation(){
        return $this->belongsTo('App\Bus_schedule', 'bus_schedule_id', 'id');
    }

}
