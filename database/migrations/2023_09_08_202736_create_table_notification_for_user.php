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
        Schema::create('notification_user', function (Blueprint $table) {
            $table->id('id_notifikasi_user');
            $table->unsignedBigInteger('id_user');
            $table->string('subject');
            $table->text('message');
            $table->boolean('read')->default(false);
            $table->timestamps();

            // Foreign key constraint untuk menghubungkan notifikasi dengan pengguna
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notification_user');
    }
};
