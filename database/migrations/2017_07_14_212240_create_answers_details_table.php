<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnswersDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('answers_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('answer');
            $table->integer('survey_question_id')->unsigned();
            $table->foreign('survey_question_id')->references('id')->on('surveys_questions');
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
        Schema::dropIfExists('answers_details');
    }
}
