<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeviceTokens extends Model
{
    protected $fillable = [
        'user_id',
        'token',
        'device',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
