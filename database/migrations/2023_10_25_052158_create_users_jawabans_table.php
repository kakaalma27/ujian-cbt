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
        Schema::create('users_jawabans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('soal_id');
            $table->foreign('soal_id')->references('id')->on('soals'); 
            $table->unsignedBigInteger('jawaban_id');
            $table->foreign('jawaban_id')->references('id')->on('jawabans'); 
            $table->unsignedBigInteger('pelajaran_id');
            $table->foreign('pelajaran_id')->references('id')->on('pelajarans');             
            $table->text('kode_akses')->nullable();
            $table->text('result')->nullable();

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
        Schema::dropIfExists('users_jawabans');
    }
};
