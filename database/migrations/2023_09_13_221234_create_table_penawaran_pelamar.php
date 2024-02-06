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
        Schema::create('penawaran_pelamar', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_pelamar_lowongan');
            $table->foreign('id_pelamar_lowongan')->references('id_pelamar_lowongan')->on('pelamar_lowongan');
            $table->bigInteger('kisaran_gaji');
            $table->bigInteger('gaji_final')->nullable();
            $table->string('status_penawaran');
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
        Schema::dropIfExists('penawaran_pelamar');
    }
};
