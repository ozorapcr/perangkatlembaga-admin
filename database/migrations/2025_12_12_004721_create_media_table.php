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
        Schema::create('media', function (Blueprint $table) {
            $table->bigIncrements('media_id');   // PK
            $table->string('ref_table', 100);     // nama tabel referensi (berita, jadwal_posyandu, dll)
            $table->unsignedBigInteger('ref_id'); // ID dari tabel tersebut
            $table->string('file_name');          // nama file (bukan URL)
            $table->string('caption')->nullable();// caption optional
            $table->string('mime_type', 100);     // jenis file
            $table->integer('sort_order')->default(0); // urutan tampil
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('media');
    }
};
