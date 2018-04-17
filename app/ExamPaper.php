<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ExamPaper extends Model
{
	use SoftDeletes;
    protected $table = 'gibs_exam_papers';
}
