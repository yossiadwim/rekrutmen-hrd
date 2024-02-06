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
        Schema::create('jenis_analisa_kriteria', function (Blueprint $table) {
            $table->id('id_jenis_analisa_kriteria');
            $table->unsignedBigInteger('id_jenis_analisa');
            $table->foreign('id_jenis_analisa')->references('id_jenis_analisa')->on('jenis_analisa');
            $table->string('jenis_analisa_kriteria');
            $table->string('kriteria');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jenis_analisa_kriteria');
    }
};
