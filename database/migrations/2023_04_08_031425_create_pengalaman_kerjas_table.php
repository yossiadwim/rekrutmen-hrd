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
        Schema::create('pengalaman_kerjas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('profil_id');
            $table->foreignId('pelamar_id');
            $table->string('nama_perusahaan');
            $table->string('jabatan');
            $table->string('bulan_mulai');
            $table->string('tahun_mulai');
            $table->string('bulan_berakhir');
            $table->string('tahun_berakhir');
            $table->boolean('masih_bekerja')->default('false');
            $table->bigInteger('gaji');
            $table->text('alasan_mengundurkan_diri');
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
        Schema::dropIfExists('pengalaman_kerjas');
    }
};
