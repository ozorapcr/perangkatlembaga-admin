<?php
// app/Models/AnggotaLembaga.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class AnggotaLembaga extends Model
{
    use HasFactory;

    protected $table = 'anggota_lembagas';
    protected $primaryKey = 'anggota_id';

    protected $fillable = [
        'lembaga_id',
        'warga_id',
        'jabatan_id',
        'tgl_mulai',
        'tgl_selesai',
    ];

    protected $casts = [
        'tgl_mulai' => 'date',
        'tgl_selesai' => 'date',
    ];

    /**
     * Relasi dengan LembagaDesa
     */
    public function lembaga()
    {
        return $this->belongsTo(Lembaga::class, 'lembaga_id', 'lembaga_id');
    }

    /**
     * Relasi dengan Warga
     */
    public function warga()
    {
        return $this->belongsTo(Warga::class, 'warga_id', 'id');
    }

    /**
     * Relasi dengan JabatanLembaga
     */
    public function jabatan()
    {
        return $this->belongsTo(JabatanLembaga::class, 'jabatan_id', 'jabatan_id');
    }

    /**
     * Scope untuk filter data
     */
    public function scopeFilter(Builder $query, $request, array $filterableColumns): Builder
    {
        foreach ($filterableColumns as $column) {
            if ($request->filled($column)) {
                if ($column === 'tgl_mulai' || $column === 'tgl_selesai') {
                    $query->whereDate($column, $request->input($column));
                } else {
                    $query->where($column, 'LIKE', '%' . $request->input($column) . '%');
                }
            }
        }
        return $query;
    }

    /**
     * Scope untuk search data
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

    /**
     * Scope untuk anggota aktif (tgl_selesai null atau di masa depan)
     */
    public function scopeAktif($query)
    {
        return $query->where(function($q) {
            $q->whereNull('tgl_selesai')
              ->orWhere('tgl_selesai', '>=', now());
        });
    }

    /**
     * Scope untuk anggota non-aktif
     */
    public function scopeNonAktif($query)
    {
        return $query->whereNotNull('tgl_selesai')
                     ->where('tgl_selesai', '<', now());
    }

    /**
     * Cek apakah anggota masih aktif
     */
    public function isAktif()
    {
        return is_null($this->tgl_selesai) || $this->tgl_selesai >= now();
    }
}
