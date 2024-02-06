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
        Schema::create('profils', function (Blueprint $table) {
            $table->id('profil_id');
            $table->foreignId('user_id');
            $table->string('nama');
            $table->string('email');
            $table->string('nomorTelepon');
            $table->foreignId('provinsi');
            $table->foreignId('kabupaten');
            $table->string('usia');
            $table->string('jenis_kelamin');
            $table->string('status_kependudukan');
            $table->string('kewarganegaraan');
            $table->string('tentang_saya');
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
        Schema::dropIfExists('profils');
    }
};
