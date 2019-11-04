<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Category;
use App\Models\Client;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Merchandise extends Model
{
    use SoftDeletes;

    protected $fillable = ['service_order', 'client_id', 'amount', 'category_id', 'input', 'withdrawn_by', 'output', 'note', 'created_by', 'updated_by', 'deleted_by'];

    public function category(int $id): string
    {
    	$category = Category::find($id);

        return $category->name;
    }

    public function client(int $id): string
    {
    	$client = Client::find($id);
        return $client->name;
    }

    public function withdrawn(?int $id): ?string
    {
    	if($id) {
    		$user = User::find($id);

    		return $user->name;
    	}

        return ''; 
    }
}
