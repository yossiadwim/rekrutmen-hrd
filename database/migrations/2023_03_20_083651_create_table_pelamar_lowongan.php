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
        Schema::create('pelamar_lowongan', function (Blueprint $table) {
            $table->id('id_pelamar_lowongan');
            $table->foreignId('id_pelamar');
            $table->foreignId('id_lowongan');
            $table->timestamp('tanggal_dibuka');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pelamar_lowongan');
    }
};
