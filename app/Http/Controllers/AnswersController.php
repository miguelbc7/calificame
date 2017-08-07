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
    public function store(Request $request)
    {
        $surveys = Surveys::find($request->survey_id);
        $surquestions = Surveys_Questions::join('questions', 'surveys_questions.question_id', '=', 'questions.id')->select('surveys_questions.id AS id', 'questions.question AS question', 'surveys_questions.position AS position')->where('surveys_questions.survey_id', '=', $request->survey_id)->get();

        $answer = new Answers;
        if ($request->name != null)
        {
            $answer->name = $request->name;
        }
        if($request->email != null)
        {
            $answer->email = $request->email;
        }
        $answer->date = date('Y-m-d');
        $answer->survey_id = $request->survey_id;
        $answer->save();

        foreach($surquestions as $sq)
        {
            $this->validate($request, [
                'option'.$sq->position => 'required',
            ]);

            $answerdetail = new AnswersDetails;
            $answerdetail->answer = $request->input('option'.$sq->position);
            if ('comment'.$sq->position != null)
            {
                $answerdetail->comment = $request->input('comment'.$sq->position);
            }
            $answerdetail->date = date('Y-m-d');
            $answerdetail->answer_id = $answer->id;
            $answerdetail->survey_id = $answer->survey_id;
            $answerdetail->question_id = $request->question_id.$sq->position;
            $answerdetail->save();
       }
       return Redirect::back();

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
