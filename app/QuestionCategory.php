<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class QuestionCategory extends Model
{
	use SoftDeletes;
    protected $table = 'gibs_question_categorys';
    // private $qc_title;

}
