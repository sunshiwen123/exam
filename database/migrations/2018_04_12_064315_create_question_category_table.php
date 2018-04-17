<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gibs_question_categorys', function (Blueprint $table) {
            $table->increments('qc_id');
            $table->string('qc_title');
            $table->mediumInteger('sub_id');
            $table->softDeletes();
            $table->timestamps();
        });
        // Schema::rename('gibs_question_category222', 'gibs_question_category');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gibs_question_categorys');
    }
}
