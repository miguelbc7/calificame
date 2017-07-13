<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Surveys_Questions extends Model
{
    /**
    * The database table used by the model.
    *
    * @var string
    */
    protected $table = 'surveys_questions';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['position', 'survey_id', 'question_id'];
}
