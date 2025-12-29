<?php
// database/migrations/xxxx_xx_xx_create_anggota_lembagas_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('anggota_lembagas', function (Blueprint $table) {
            $table->id('anggota_id');
            $table->unsignedBigInteger('lembaga_id');
            $table->unsignedBigInteger('warga_id');
            $table->unsignedBigInteger('jabatan_id');
            $table->date('tgl_mulai');
            $table->date('tgl_selesai')->nullable();
            $table->timestamps();

            $table->foreign('lembaga_id')
                  ->references('lembaga_id')
                  ->on('lembaga_desas')
                  ->onDelete('cascade');

            $table->foreign('warga_id')
                  ->references('id')
                  ->on('wargas')
                  ->onDelete('cascade');

            $table->foreign('jabatan_id')
                  ->references('jabatan_id')
                  ->on('jabatan_lembagas')
                  ->onDelete('cascade');

            $table->index('lembaga_id');
            $table->index('warga_id');
            $table->index('jabatan_id');
        });
    }

    public function down()
    {
        Schema::dropIfExists('anggota_lembagas');
    }
};