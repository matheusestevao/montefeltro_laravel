<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Client extends Model
{
    protected $fillable = ['name', 'external_id', 'internal_id'];

    public function external_id(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function internal_id(): HasMany
    {
        return $this->hasMany(User::class);
    }
}
