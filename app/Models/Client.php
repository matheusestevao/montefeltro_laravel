<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Merchandise;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Client extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'external_id', 'internal_id', 'note', 'created_by', 'updated_by', 'deleted_by'];

    public function external(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'external_id');
    }

    public function internal(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'internal_id');
    }

    public function merchandise(): belongsTo
    {
        return $this->belongsTo(Merchandise::class, 'client_id', ' id');
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
