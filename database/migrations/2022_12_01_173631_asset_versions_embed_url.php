<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AssetVersionsEmbedUrl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('asset_versions', function (Blueprint $table) {
        $table->string('embed_url')->nullable(true);
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
      Schema::table('asset_versions', function (Blueprint $table) {
        $table->dropColumn('embed_url');
      });
    }
}
