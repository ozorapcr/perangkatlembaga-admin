<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('perangkat_desa', function (Blueprint $table) {
            $table->bigIncrements('perangkat_id'); // PK
            $table->unsignedBigInteger('warga_id'); // FK ke warga
            $table->string('jabatan');
            $table->string('nip')->nullable();
            $table->string('kontak')->nullable();
            $table->date('periode_mulai');
            $table->date('periode_selesai')->nullable();
            $table->timestamps();

            // relasi ke warga
            $table->foreign('warga_id')->references('warga_id')->on('warga')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('perangkat_desa');
    }
};
