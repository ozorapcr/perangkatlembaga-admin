<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Lembaga extends Model
{
    use HasFactory;

    protected $table = 'lembaga_desas';
    protected $primaryKey = 'lembaga_id';
    
    protected $fillable = [
        'nama_lembaga',
        'deskripsi',
        'kontak',
    ];

    /**
     * Scope untuk filter data Lembaga Desa
     */
    public function scopeFilter(Builder $query, $request, array $filterableColumns): Builder
    {
        foreach ($filterableColumns as $column) {
            if ($request->filled($column)) {
                if ($column === 'filter_kontak') {
                    if ($request->input($column) === 'ada') {
                        $query->whereNotNull('kontak');
                    } elseif ($request->input($column) === 'tidak_ada') {
                        $query->whereNull('kontak');
                    }
                } else {
                    $query->where($column, 'LIKE', '%' . $request->input($column) . '%');
                }
            }
        }
        return $query;
    }

    /**
     * Scope untuk search data Lembaga Desa
     */
    public function scopeSearch($query, $request, array $columns)
    {
        if ($request->filled('search')) {
            $query->where(function($q) use ($request, $columns) {
                foreach ($columns as $column) {
                    $q->orWhere($column, 'LIKE', '%' . $request->search . '%');
                }
            });
        }
        return $query;
    }

    // Jika ada relasi dengan perangkat desa
    public function perangkats()
    {
        return $this->hasMany(Perangkat::class, 'lembaga_id');
    }
}