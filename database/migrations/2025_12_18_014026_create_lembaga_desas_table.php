<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('lembaga_desas', function (Blueprint $table) {
            $table->id('lembaga_id');
            $table->string('nama_lembaga', 100);
            $table->text('deskripsi')->nullable();
            $table->string('kontak', 50)->nullable();
            $table->timestamps();
            
            $table->index('nama_lembaga');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lembaga_desas');
    }
};