<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChairRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chair_room', function (Blueprint $table) {
            $table->unsignedBigInteger("fk_id_room");
            $table->unsignedBigInteger("fk_id_chair");
            $table->integer("number_chair")->nullable();
            $table->primary(["fk_id_chair", "fk_id_room"]);
            $table->foreign('fk_id_chair')->references('id')->on('chairs')->onUpdate("cascade")->onDelete("cascade");
            $table->foreign('fk_id_room')->references('id')->on('rooms')->onUpdate("cascade")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('chair_rooms');
    }
}
