<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class QuestionType extends Model
{
	use SoftDeletes;
    protected $table = 'gibs_question_types';
}
