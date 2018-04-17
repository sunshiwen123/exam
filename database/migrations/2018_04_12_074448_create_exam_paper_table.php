<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExamPaperTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gibs_exam_papers', function (Blueprint $table) {
            $table->increments('ep_id');
            $table->string('ep_title');
            $table->float('ep_score_total', 8, 2);
            $table->mediumInteger('ep_tc_id');
            $table->string('ep_use');
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
        Schema::dropIfExists('gibs_exam_papers');
    }
}
