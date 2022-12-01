<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AssetsEmbedUrl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('assets', function (Blueprint $table) {
          $table->string('embed_url')->nullable(true);
          $table->unsignedBigInteger('asset_template_id')->nullable(true);
          $table->foreign('asset_template_id')->references('asset_id')->on('assets');
          $table->unsignedBigInteger('asset_template_version_id')->nullable(true);
          $table->foreign('asset_template_version_id')->references('id')->on('asset_versions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('assets', function (Blueprint $table) {
        $table->dropColumn('embed_url');
      });
    }
}
