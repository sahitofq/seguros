<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWsCitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ws_cities', function (Blueprint $table) {
            $table->id("ct_id");

            $table->string("ct_name", 250);
            $table->string("ct_code", 100)->unique();

            $table->timestamp("ct_created")->nullable();
            $table->timestamp("ct_updated")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ws_cities');
    }
}
