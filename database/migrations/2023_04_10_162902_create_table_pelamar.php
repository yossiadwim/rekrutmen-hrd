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
        Schema::create('pelamars', function (Blueprint $table) {
            $table->id('id_pelamar');
            $table->string('nama_pelamar');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('google_id')->nullable();
            $table->string('jenis_kelamin')->nullable();
            $table->string('tempat_lahir')->nullable();
            $table->string('tanggal_lahir')->nullable();
            $table->string('alamat')->nullable();
            $table->string('telepon_rumah')->nullable();
            $table->string('telepon_kantor')->nullable();
            $table->string('suku')->nullable();
            $table->string('kebangsaan')->nullable();
            $table->foreignId('id_agama')->nullable();
            $table->integer('tinggi_badan')->nullable();
            $table->integer('berat_badan')->nullable();
            $table->string('status_perkawinan')->nullable();
            $table->string('nama_pasangan')->nullable();
            $table->integer('jumlah_anak')->nullable();
            $table->string('hobi')->nullable();
            $table->string('organisasi')->nullable();
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
        Schema::dropIfExists('pelamars');
    }
};
