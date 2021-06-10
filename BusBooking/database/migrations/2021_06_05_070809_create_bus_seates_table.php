<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusSeatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bus_seates', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('bus_id');
            $table->string('seat_number');
            $table->float('price', 8, 2);
            $table->foreign('bus_id')->references('id')->on('buses');
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
        Schema::dropIfExists('bus_seates');
    }
}
