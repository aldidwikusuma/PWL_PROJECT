<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->string("date");
            $table->string("time");
            $table->string("endtime");
            $table->unsignedBigInteger('fk_id_film');
            $table->foreign("fk_id_film")->references("id")->on("films");
            $table->unsignedBigInteger('fk_id_room');
            $table->foreign("fk_id_room")->references("id")->on("rooms");
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
        Schema::dropIfExists('schedules');
    }
}
