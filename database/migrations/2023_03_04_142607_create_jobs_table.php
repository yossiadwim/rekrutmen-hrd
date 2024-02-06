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
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_departemen');
            $table->string('nama_lowongan');
            $table->string('slug');
            $table->string('tipe_lowongan');
            $table->text('deskripsi');
            $table->timestamp('tanggal_dibuka')->nullable();
            $table->boolean('closed')->default('false');
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
        Schema::dropIfExists('jobs');
    }
};

?>