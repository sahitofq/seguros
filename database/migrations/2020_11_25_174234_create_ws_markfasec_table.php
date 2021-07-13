<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWsMarkfasecTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ws_markfasec', function (Blueprint $table) {
            $table->id("mf_id");

            $table->string("mf_name", 250);
            $table->string("mf_code", 100)->unique();

            $table->timestamp("mf_created")->nullable();
            $table->timestamp("mf_updated")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ws_markfasec');
    }
}
