<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property string $token
 * @property bool $active
 * @property \Carbon\Carbon $last_used_at
 * @property \Carbon\Carbon $expires_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $created_at
 */
class ApiToken extends Model
{
    protected $fillable = [
        'name',
        'token',
        'active',
        'last_used_at',
        'expires_at'
    ];

    protected $casts = [
        'updated_at' => 'datetime',
        'created_at' => 'datetime',
        'expires_at' => 'datetime'
    ];
}
