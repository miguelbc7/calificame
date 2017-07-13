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
use App\Surveys_QuestionS;

class Surveys_QuestionsController extends Controller
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
        if(isset($request->question))
        {
            $this->validate($request, [
                'question' => 'required',
            ]);
            $questions = new Questions;
            $questions->fill($request->all());
            $questions->user_id = Auth::id();
            $questions->save();

            $surques = new Surveys_Questions;
            $surques->survey_id = $request->survey_id;
            $surques->question_id = $questions->id;
            $surques->save();

            return Redirect::back()->with('message','Pregunta Agregada Correctamente');
        }
        elseif(isset($request->question_id))
        {
            $this->validate($request, [
                'question_id' => 'required',
            ]);

            $surques = new Surveys_Questions;
            $surques->survey_id = $request->survey_id;
            $surques->question_id = $request->question_id;
            $surques->save();

            return Redirect::back()->with('message','Pregunta Agregada Correctamente');
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
