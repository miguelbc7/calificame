<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use Redirect;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;
use App\Surveys;
use App\Questions;
use App\Surveys_Questions;
use App\Answers;
use App\AnswersDetails;

class AnswersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|max:255|email',
        ]);

        $surveys = Surveys::find($request->survey_id);
        $questions = Questions::where('survey_id','=',$request->survey_id)->count();

        $surquestions = Surveys_Questions::join('questions', 'surveys_questions.question_id', '=', 'questions.id')->select('surveys_questions.id AS id', 'questions.question AS question', 'surveys_questions.position AS position')->where('surveys_questions.survey_id', '=', $request->survey_id)->get();

        $answer = new Answers;
        $answer->fill($request->all());
        $answer->survey_id = $request->survey_id;
        $answer->save();

        foreach($surquestions as $sq)
        {
            $i = 1;
            while ($i <= $questions)
            {
                 $this->validate($request, [
                    'optionsRadios'.$sq->position => 'required',
                ]);

                 $answerdetail = new AnswersDetails;
                 $answerdetail->answer = $request->optionsRadios.$sq->position;
                 $answerdetail->answer_id = $answer->id;
                 $answerdetail->question_id = $request->question_id;
                 $answerdetail->save();
            }
       }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
