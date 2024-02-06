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
        Schema::create('hasil_analisa', function (Blueprint $table) {
            $table->id('id_hasil_analisa');
            $table->unsignedBigInteger('id_tipe_analisa');
            $table->foreign('id_tipe_analisa')->references('id_tipe_analisa')->on('tipe_analisa');
            $table->unsignedBigInteger('id_jenis_analisa');
            $table->foreign('id_jenis_analisa')->references('id_jenis_analisa')->on('jenis_analisa');
            $table->unsignedBigInteger('id_pelamar_lowongan');
            $table->foreign('id_pelamar_lowongan')->references('id_pelamar_lowongan')->on('pelamar_lowongan');
            $table->string('id_karyawan');
            $table->foreign('id_karyawan')->references('id_karyawan')->on('karyawan');
            $table->integer('poin');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hasil_analisa');
    }
};
