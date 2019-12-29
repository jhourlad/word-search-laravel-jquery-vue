<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePreviousSearchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('previous_searches', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('word');
            $table->string('part_of_speech', 15)->nullable();
            $table->longText('definition');
            $table->unsignedBigInteger('hits');
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
        Schema::dropIfExists('previous_searches');
    }
}
