<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EpQtypeRelation extends Model
{
	use SoftDeletes;
    protected $table = 'gibs_ep_questiontype_relations';
}
