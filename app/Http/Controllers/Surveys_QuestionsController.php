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

            $sq = Surveys_Questions::where('survey_id', '=', $request->survey_id)->count();

            if($sq == 0)
            {
                $position = 1;
            }
            else
            {
                $sq2 = Surveys_Questions::orderBy('position', 'desc')->first();
                $position = $sq2->position + 1;
            }

            $questions = new Questions;
            $questions->fill($request->all());
            $questions->user_id = Auth::id();
            $questions->save();

            $surques = new Surveys_Questions;
            $surques->position = $position;
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

            $sq = Surveys_Questions::where('survey_id', '=', $request->survey_id)->count();

            if($sq == 0)
            {
                $position = 1;
            }
            else
            {
                $sq2 = Surveys_Questions::orderBy('position', 'desc')->first();
                $position = $sq2->position + 1;
            }

            $surques = new Surveys_Questions;
            $surques->position = $position;
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

    public function up($id)
    {
        $surques = Surveys_Questions::find($id);
        $i = $surques->position - 1;
        $sq = Surveys_Questions::where('position', '=', $i)->update(['position' => $surques->position]);
        $surques->position = $i;
        $surques->save();
        return Redirect::back();
    }

    public function down($id)
    {
        $surques = Surveys_Questions::find($id);
        $i = $surques->position + 1;
        $sq = Surveys_Questions::where('position', '=', $i)->update(['position' => $surques->position]);
        $surques->position = $i;
        $surques->save();
        return Redirect::back();
    }

    public function fullUp($id)
    {
        $surques = Surveys_Questions::find($id);
        $sq = Surveys_Questions::where('position', '<', $surques->position)->get();

        foreach($sq as $s)
        {
            $sq = Surveys_Questions::find($s->id);
            $sq->position = $s->position + 1;
            $sq->save();
        }
        $surques->position = 1;
        $surques->save();
        return Redirect::back();
    }

    public function fullDown($id)
    {
        $surques = Surveys_Questions::find($id);
        $sq = Surveys_Questions::where('position', '>', $surques->position)->get();
        $pos = Surveys_Questions::select('position')->orderBy('position', 'desc')->first();
        
        foreach($sq as $s)
        {
            $sq = Surveys_Questions::find($s->id);
            $sq->position = $s->position - 1;
            $sq->save();
        }
        
        $surques->position = $pos->position;
        $surques->save();
        return Redirect::back();
    }
}
