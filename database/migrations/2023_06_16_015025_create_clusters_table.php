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
        Schema::create('clusters', function (Blueprint $table) {
            $table->id('id_cluster');
            $table->string('nama_cluster');
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('clusters');
    }
};
