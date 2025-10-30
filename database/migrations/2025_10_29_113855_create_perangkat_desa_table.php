<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('perangkat', function (Blueprint $table) {
            $table->id();
            $table->foreignId('warga_id')->constrained('warga')->onDelete('cascade');
            $table->string('jabatan', 100);
            $table->string('nip', 50)->nullable();
            $table->string('kontak', 20)->nullable();
            $table->date('periode_mulai')->nullable();
            $table->date('periode_selesai')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('perangkat');
    }
};
