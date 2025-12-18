<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rts', function (Blueprint $table) {
            $table->id('rt_id');
            $table->unsignedBigInteger('rw_id');
            $table->string('nomor_rt', 3);
            $table->unsignedBigInteger('ketua_rt_warga_id')->nullable();
            $table->text('keterangan')->nullable();
            $table->timestamps();

            // Foreign key ke tabel rws
            $table->foreign('rw_id')
                  ->references('id')
                  ->on('rws')
                  ->onDelete('cascade');
            
            // Untuk foreign key ke warga (jika tabel warga ada)
            // $table->foreign('ketua_rt_warga_id')
            //       ->references('id')
            //       ->on('wargas')
            //       ->onDelete('set null');
            
            // Pastikan nomor RT unik dalam satu RW
            $table->unique(['rw_id', 'nomor_rt']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rts');
    }
};