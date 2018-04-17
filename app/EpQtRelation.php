<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EpQtRelation extends Model
{
	use SoftDeletes;
    protected $table = 'gibs_ep_qt_relations';
}
