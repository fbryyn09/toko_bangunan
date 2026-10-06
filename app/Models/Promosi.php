<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Promosi extends Model
{
    protected $table = 'promosi';

    protected $primaryKey = 'id_promosi';

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'id_promosi',
        'nama_promosi',
        'deskripsi',
        'jenis_diskon',
        'nilai_diskon',
        'tanggal_mulai',
        'tanggal_selesai',
        'gambar',
        'status',
    ];

    public function produk(): BelongsToMany
    {
        return $this->belongsToMany(
            Produk::class,
            'produk_promosi',
            'id_promosi',
            'id_produk',
            'id_promosi',
            'id_produk'
        );
    }
}