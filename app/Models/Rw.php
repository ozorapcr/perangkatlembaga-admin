<?php

namespace App\Models;

use App\Models\Warga;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Rw extends Model
{
    use HasFactory;

    protected $table = 'rws';

    protected $fillable = [
        'nomorRw',
        'ketuaRwWargaId',
        'keterangan',
    ];

    /**
     * Scope untuk filter data RW
     */
    public function scopeFilter(Builder $query, $request, array $filterableColumns): Builder
    {
        foreach ($filterableColumns as $column) {
            if ($request->filled($column)) {
                if ($column === 'filter_ketua') {
                    if ($request->input($column) === 'ada') {
                        $query->whereNotNull('ketuaRwWargaId');
                    } elseif ($request->input($column) === 'tidak_ada') {
                        $query->whereNull('ketuaRwWargaId');
                    }
                } else {
                    $query->where($column, 'LIKE', '%' . $request->input($column) . '%');
                }
            }
        }
        return $query;
    }

    /**
     * Scope untuk search data RW
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


    public function ketua()
    {
        return $this->belongsTo(Warga::class, 'ketuaRwWargaId','id');
    }
}
