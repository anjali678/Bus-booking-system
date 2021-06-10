<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

// sanctum
use Laravel\Sanctum\HasApiTokens;

class Super_admin extends Model
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $fillable = [
        'name',
        'email',
        'password',
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];


    public function getRouteRelation(){
    	return $this->hasMany('App\Route');
    }

    public function getbusesRelation(){
    	return $this->hasMany('App\Bus');
    }

    public function getbus_routesRelation(){
    	return $this->hasMany('App\Bus_route');
    }

    public function getbus_seatsRelation(){
    	return $this->hasMany('App\Bus_seat');
    }

    public function getbus_schedulesRelation(){
    	return $this->hasMany('App\Bus_schedule');
    }

}
