<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Client extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'external_id', 'internal_id', 'note', 'created_by', 'updated_by', 'deleted_by'];

    public function external_id(): HasMany
    {
        return $this->hasMany(User::class, 'external_id');
    }

    public function internal_id(): HasMany
    {
        return $this->hasMany(User::class, 'internal_id');
    }

    public function sellerName(?int $id): ?string
    {
        if($id) {
            $name = User::find($id);

            return $name->name;
        }
        
        return '';
    }
}
