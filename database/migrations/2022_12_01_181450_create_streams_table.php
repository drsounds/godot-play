<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStreamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('streams', function (Blueprint $table) {
            $table->unsignedBigInteger('asset_id');
            $table->foreign('asset_id')->references('asset_id')->on('assets');
            $table->unsignedBigInteger('asset_version_id');
            $table->foreign('asset_version_id')->references('id')->on('asset_versions');
            $table->unsignedBigInteger('user_id')->null(true);
            $table->foreign('player_id')->references('user_id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('streams');
    }
}
