<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hasil_clusters', function (Blueprint $table) {

            $table->id('id_hasil');
            $table->unsignedBigInteger('cluster_id');
            $table->unsignedInteger('kecamatan_id');
            $table->timestamps();

            $table->foreign('kecamatan_id')->references('kecamatan_id')->on('stuntings')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hasil_clusters');
    }
};
