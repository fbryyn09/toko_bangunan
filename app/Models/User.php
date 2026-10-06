<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasOne;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'users';

    protected $primaryKey = 'id_user';

    public $incrementing = false;

    protected $keyType = 'string';


    protected $fillable = [
        'id_user',
        'nama',
        'username',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
    ];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    public function pelanggan(): HasOne
    {
        return $this->hasOne(Pelanggan::class, 'id_user', 'id_user');
    }
}
