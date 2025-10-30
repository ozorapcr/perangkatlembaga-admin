<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warga extends Model
{
    use HasFactory;

    // Pastikan nama tabel sesuai dengan migrasi
    protected $table = 'warga';

    protected $fillable = [
        'nama',
        'nik',
        'alamat',
        'no_hp',
    ];

    // Relasi ke perangkat desa
    public function perangkat()
    {
        return $this->hasMany(Perangkat::class, 'warga_id');
    }
}
