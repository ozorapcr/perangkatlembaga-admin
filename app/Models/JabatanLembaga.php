<?php
// app/Models/JabatanLembaga.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class JabatanLembaga extends Model
{
    use HasFactory;

    protected $table = 'jabatan_lembagas';
    protected $primaryKey = 'jabatan_id';
    
    protected $fillable = [
        'lembaga_id',
        'nama_jabatan',
        'level',
    ];

    /**
     * Relasi dengan LembagaDesa
     */
    public function lembaga()
    {
        return $this->belongsTo(LembagaDesa::class, 'lembaga_id', 'lembaga_id');
    }

    /**
     * Scope untuk filter data
     */
    public function scopeFilter(Builder $query, $request, array $filterableColumns): Builder
    {
        foreach ($filterableColumns as $column) {
            if ($request->filled($column)) {
                $query->where($column, 'LIKE', '%' . $request->input($column) . '%');
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
}