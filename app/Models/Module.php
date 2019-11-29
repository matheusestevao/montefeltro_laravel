<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    public $timestamps = false;
	protected $fillable = ['name', 'label', 'group', 'menu_left', 'menu_icon', 'page_index', 'menu_master'];

}
