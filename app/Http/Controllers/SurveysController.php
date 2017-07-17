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

class SurveysController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $surveys = Surveys::where('user_id', '=', Auth::id())->paginate(10);
        return view('data.surveys.index', ['surveys'=>$surveys]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('data.surveys.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
        ]);

        $surveys = new Surveys;
        $surveys->fill($request->all());
        $surveys->user_id = Auth::id();
        $surveys->save();
        return redirect('/surveys/'.$surveys->id.'/questions')->with('message','Encuesta Registrada Correctamente');
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
        $surveys = Surveys::find($id);
        return view('data.surveys.edit', ['surveys'=>$surveys]);
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
        $this->validate($request, [
            'name' => 'required|max:255',
        ]);

        $surveys = Surveys::find($id);
        $surveys->fill($request->all());
        $surveys->save();
        return redirect('/surveys')->with('message','Encuesta Actualizada Correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $surveys = Surveys::find($id);
        $surveys->delete();
        return redirect('/surveys')->with('error','Encuesta Eliminada Correctamente');
    }

    public function questions($id)
    {
        $surveys = Surveys::find($id);
        $surquestions = Surveys_Questions::join('questions', 'surveys_questions.question_id', '=', 'questions.id')->select('surveys_questions.id AS id', 'questions.question AS question', 'surveys_questions.position AS position')->where('surveys_questions.survey_id', '=', $id)->orderBy('position', 'asc')->paginate(10);
        $questions = Questions::where('user_id', '=', Auth::id())->orderBy('question')->pluck('question', 'id');
        $last = Surveys_Questions::select('position')->orderBy('position', 'desc')->first();
        if(isset($last))
        {
            $last = $last->position;
        }
        else
        {
            $last = 0;
        }
        
        return view('data.surveys.questions', ['surveys'=>$surveys, 'surquestions'=>$surquestions, 'questions'=>$questions, 'last'=>$last]);
    }

    public function survey($id)
    {
        $surveys = Surveys::find($id);
        $surquestions = Surveys_Questions::join('questions', 'surveys_questions.question_id', '=', 'questions.id')->select('surveys_questions.id AS id', 'questions.id AS question_id', 'questions.question AS question', 'surveys_questions.position AS position')->where('surveys_questions.survey_id', '=', $id)->get();
        return view('pages.survey', ['surveys'=>$surveys, 'surquestions'=>$surquestions]);
    }
}
