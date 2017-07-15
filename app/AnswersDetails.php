<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AnswersDetails extends Model
{
   	/**
    * The database table used by the model.
    *
    * @var string
    */
    protected $table = 'answers_details';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['answer, survey_question_id'];
}
