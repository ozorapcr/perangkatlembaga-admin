<?php
// database/migrations/xxxx_xx_xx_create_jabatan_lembagas_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('jabatan_lembagas', function (Blueprint $table) {
            $table->id('jabatan_id');
            $table->unsignedBigInteger('lembaga_id');
            $table->string('nama_jabatan');
            $table->integer('level');
            $table->timestamps();

            $table->foreign('lembaga_id')
                  ->references('lembaga_id')
                  ->on('lembaga_desas')
                  ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('jabatan_lembagas');
    }
};