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
            $table->string('jenis_kelamin');
            $table->string('tempat_lahir');
            $table->string('tanggal_lahir');
            $table->string('alamat');
            $table->string('telepon_rumah');
            $table->string('telepon_kantor');
            $table->string('suku');
            $table->string('kebangsaan');
            $table->foreignId('id_agama');
            $table->integer('tinggi_badan');
            $table->integer('berat_badan');
            $table->string('status_perkawinan');
            $table->string('nama_pasangan');
            $table->integer('jumlah_anak');
            $table->string('hobi')->nullable();
            $table->string('organisasi')->nullable();
            $table->foreignId('id_user');
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
