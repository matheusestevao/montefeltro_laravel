<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Permission;

class Role extends Model
{
	public $timestamps = false;
	protected $fillable = ['name', 'label', 'master_role'];

	public function permissions(): belongsToMany
    {
    	return $this->belongsToMany(Permission::class);
    }

    public function masterRole(): hasOne
    {
    	return $this->hasOne("App\Models\Role","id","master_role");
    }

}
