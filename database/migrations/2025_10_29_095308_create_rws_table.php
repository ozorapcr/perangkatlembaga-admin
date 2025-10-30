<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rws', function (Blueprint $table) {
            $table->id();
            $table->string('nomorRw');
            $table->unsignedBigInteger('ketuaRwWargaId')->nullable();
            $table->text('keterangan')->nullable();
            $table->timestamps();

            // Jika nanti ada tabel warga:
            // $table->foreign('ketuaRwWargaId')->references('id')->on('wargas')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rws');
    }
};
