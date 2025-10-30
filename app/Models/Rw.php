<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rw extends Model
{
    use HasFactory;

    protected $table = 'rws';

    protected $fillable = [
        'nomorRw',
        'ketuaRwWargaId',
        'keterangan',
    ];

    // Jika ada relasi ke tabel warga
    // public function ketua()
    // {
    //     return $this->belongsTo(Warga::class, 'ketuaRwWargaId');
    // }
}
