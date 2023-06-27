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
        Schema::create('stuntings', function (Blueprint $table) {
            $table->increments('id_stunting');
            $table->unsignedInteger('kecamatan_id');
            $table->integer('jumlah_stunting');
            $table->integer('usia');
            $table->string('berat_badan');
            $table->string('tinggi_badan');
            $table->string('tingkat_stunting');
            $table->timestamps();

            $table->foreign('kecamatan_id')
                ->references('id_kecamatan')
                ->on('kecamatans')
                ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('stuntings');
    }
};
