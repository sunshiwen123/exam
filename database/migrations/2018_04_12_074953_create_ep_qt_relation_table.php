<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEpQtRelationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gibs_ep_qt_relations', function (Blueprint $table) {
            $table->increments('id');
            $table->mediumInteger('ep_id');
            $table->mediumInteger('qt_id');
            $table->string('ep_use');
            $table->mediumInteger('qtype_id');
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
        Schema::dropIfExists('gibs_ep_qt_relations');
    }
}
