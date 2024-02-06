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
        Schema::table('profils', function (Blueprint $table) {
            $table->string('nama');
            $table->string('provinsi');
            $table->string('kabupaten');
            $table->string('usia');
            $table->string('jenis_kelamin');
            $table->string('status_kependudukan');
            $table->string('kewarganegaraan');
            $table->string('tentang_saya');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('profils', function (Blueprint $table) {
            //
        });
    }
};
