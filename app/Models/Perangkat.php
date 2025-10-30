<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perangkat extends Model
{
    use HasFactory;

    protected $table = 'perangkat';

    protected $fillable = [
        'warga_id',
        'jabatan',
        'nip',
        'kontak',
        'periode_mulai',
        'periode_selesai',
    ];

    // Relasi ke tabel warga
    public function warga()
    {
        return $this->belongsTo(Warga::class, 'warga_id');
    }
}
