<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pelanggan extends Model
{
    protected $table = 'pelanggan';

    protected $primaryKey = 'id_pelanggan';

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'id_pelanggan',
        'id_user',
        'no_hp',
        'email',
        'alamat',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(
            User::class,
            'id_user',
            'id_user'
        );
    }

    public function pesanan(): HasMany
    {
        return $this->hasMany(
            Pesanan::class,
            'id_pelanggan',
            'id_pelanggan'
        );
    }
}