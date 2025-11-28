<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

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

    // Scope untuk filter - SAMA PERSIS seperti di Perangkat
    public function scopeFilter(Builder $query, $request, array $filterableColumns): Builder
    {
        foreach ($filterableColumns as $column) {
            if ($request->filled($column)) {
                $query->where($column, $request->input($column));
            }
        }
        return $query;
    }

    // Scope untuk search - SAMA PERSIS seperti di Perangkat
    public function scopeSearch($query, $request, array $columns)
    {
        if ($request->filled('search')) {
            $query->where(function($q) use ($request, $columns) {
                foreach ($columns as $column) {
                    $q->orWhere($column, 'LIKE', '%' . $request->search . '%');
                }
            });
        }
    }
}