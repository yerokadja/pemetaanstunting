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
        Schema::create('kecamatans', function (Blueprint $table) {
            $table->increments('id_kecamatan');
            $table->string('kode_kecamatan');
            $table->string('nama_kecamatan');
            $table->string('file_geo_json');
            $table->string('warna');
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('kecamatans');
    }
};
