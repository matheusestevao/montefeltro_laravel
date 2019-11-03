<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Merchandise extends Model
{
    use SoftDeletes;

    protected $fillable = ['service_order', 'category_id', 'input', 'withdrawn_by', 'output', 'note', 'created_by', 'updated_by', 'deleted_by'];

    public function category(): string
    {
    	$category = $this->hasMany(Category::class, 'id', 'category_id');
        
        return $category->name;
    }

    public function withdrawn(): string
    {
    	$seller = $this->hasMany(User::class, 'id', 'withdrawn_by');

        return $seller->name; 
    }
}
