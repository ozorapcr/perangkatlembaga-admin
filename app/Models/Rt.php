<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Rt extends Model
{
    use HasFactory;

    protected $table = 'rts';
    protected $primaryKey = 'rt_id';

    protected $fillable = [
        'rw_id',
        'nomor_rt',
        'ketua_rt_warga_id',
        'keterangan',
    ];

    /**
     * Relasi ke RW
     */
    public function rw()
    {
        return $this->belongsTo(Rw::class, 'rw_id', 'id');
    }

    /**
     * Relasi ke Warga (ketua RT)
     * Hapus komentar jika tabel warga sudah ada
     */
    // public function ketua()
    // {
    //     return $this->belongsTo(Warga::class, 'ketua_rt_warga_id', 'id');
    // }

    /**
     * Scope untuk filter data RT
     */
    public function scopeFilter(Builder $query, $request, array $filterableColumns): Builder
    {
        foreach ($filterableColumns as $column) {
            if ($request->filled($column)) {
                if ($column === 'rw_id') {
                    $query->where('rw_id', $request->input($column));
                } elseif ($column === 'filter_ketua') {
                    if ($request->input($column) === 'ada') {
                        $query->whereNotNull('ketua_rt_warga_id');
                    } elseif ($request->input($column) === 'tidak_ada') {
                        $query->whereNull('ketua_rt_warga_id');
                    }
                } else {
                    $query->where($column, 'LIKE', '%' . $request->input($column) . '%');
                }
            }
        }
        return $query;
    }

    /**
     * Scope untuk search data RT
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
}