<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TreeCategory extends Model
{
	use SoftDeletes;
	
    protected $table = 'gibs_tree_categorys';
}
