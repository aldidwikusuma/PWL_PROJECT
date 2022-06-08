<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('films', function (Blueprint $table) {
            $table->id();
            $table->string("title")->unique();
            $table->string("image")->nullable();
            $table->text("desc");
            $table->integer("duration");
            $table->integer("release_year");
            $table->string("rating");
            $table->unsignedBigInteger('fk_id_genre');
            $table->foreign("fk_id_genre")->references("id")->on("genres");
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
        Schema::dropIfExists('films');
    }
}
