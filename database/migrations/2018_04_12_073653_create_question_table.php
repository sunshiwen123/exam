<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gibs_questions', function (Blueprint $table) {
            $table->increments('qt_id');
            $table->string('qt_title');
            $table->longText('qt_description');
            $table->mediumInteger('qt_difficulty');
            $table->float('qt_score', 8, 2);
            $table->mediumInteger('qtype_id');
            $table->mediumInteger('sub_id');
            $table->mediumInteger('qc_id');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gibs_questions');
    }
}
