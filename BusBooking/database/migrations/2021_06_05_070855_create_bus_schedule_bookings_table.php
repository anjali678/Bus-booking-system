<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusScheduleBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bus_schedule_bookings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('bus_seate_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('bus_schedule_id');
            $table->string('seat_number');
            $table->float('price', 8, 2);
            $table->set('status', ['cancel', 'active']);
            $table->foreign('bus_seate_id')->references('id')->on('bus_seates');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('bus_schedule_id')->references('id')->on('bus_schedules');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bus_schedule_bookings');
    }
}
