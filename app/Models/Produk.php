<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Produk extends Model
{
    protected $table = 'produk';

    protected $primaryKey = 'id_produk';
    public $incrementing = false;
    protected $keyType = 'string';


    protected $fillable = [
        'id_produk',
        'id_kategori',
        'nama_produk',
        'deskripsi',
        'harga',
        'stok',
        'satuan',
        'gambar',
        'status',
    ];

    public function kategori(): BelongsTo
    {
        return $this->belongsTo(
            Kategori::class,
            'id_kategori',
            'id_kategori'
        );
    }

    public function promosi(): BelongsToMany
    {
        return $this->belongsToMany(
            Promosi::class,
            'produk_promosi',
            'id_produk',
            'id_promosi',
            'id_produk',
            'id_promosi'
        );
    }

    public function detailPesanan(): HasMany
    {
        return $this->hasMany(
            DetailPesanan::class,
            'id_produk',
            'id_produk'
        );
    }
}
