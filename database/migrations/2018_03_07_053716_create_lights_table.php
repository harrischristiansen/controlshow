<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLightsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lights', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('bridge_id')->foreign()->references('id')->on('bridges');
            $table->integer('lightID');
            $table->enum('type', ['circle', 'square', 'box_tall', 'box_wide']);
            $table->float('loc_x', 8, 7)->default(0);
            $table->float('loc_y', 8, 7)->default(0);
            $table->string('room')->nullable();
            $table->integer('index_in_room')->nullable();
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
        Schema::dropIfExists('lights');
    }
}
