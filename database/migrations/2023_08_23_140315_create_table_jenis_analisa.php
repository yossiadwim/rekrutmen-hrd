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
        Schema::create('jenis_analisa', function (Blueprint $table) {
            $table->id('id_jenis_analisa');
            $table->unsignedBigInteger('id_tipe_analisa');  
            $table->foreign('id_tipe_analisa')->references('id_tipe_analisa')->on('tipe_analisa');
            $table->integer('bobot_minimal');
            $table->integer('bobot_maksimal');
            
        
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jenis_analisa');
    }
};
