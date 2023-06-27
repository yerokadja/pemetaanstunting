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
        Schema::create('pasien', function (Blueprint $table) {
            $table->id('id_pasien');
            $table->string('nama');
            $table->string('jenis_kelamin');
            $table->string('alamat');
            $table->decimal('berat_badan', 5, 2);
            $table->string('berat_badan_satuan')->default('kg');
            $table->decimal('tinggi_badan', 5, 2);
            $table->string('tinggi_badan_satuan')->default('cm');
            $table->float('lingkar_badan', 5, 2);
            $table->float('lingkar_perut', 5, 2);
            $table->string('status');
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
        Schema::dropIfExists('pasien');
    }
};
