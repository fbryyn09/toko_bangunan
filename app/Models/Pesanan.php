<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pesanan extends Model
{
    protected $table = 'pesanan';

    protected $primaryKey = 'id_pesanan';

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'id_pesanan',
        'id_pelanggan',
        'tanggal_pesanan',
        'total_harga',
        'metode_pembayaran',
        'status_pesanan',
        'catatan',
    ];

    protected function casts(): array
    {
        return [
            'tanggal_pesanan' => 'datetime',
            'total_harga' => 'decimal:2',
        ];
    }

    public function pelanggan(): BelongsTo
    {
        return $this->belongsTo(
            Pelanggan::class,
            'id_pelanggan',
            'id_pelanggan'
        );
    }

    public function detailPesanan(): HasMany
    {
        return $this->hasMany(
            DetailPesanan::class,
            'id_pesanan',
            'id_pesanan'
        );
    }
}