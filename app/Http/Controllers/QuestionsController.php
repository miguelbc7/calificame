<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use Redirect;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;
use App\Questions;
use App\Surveys_Questions;

class QuestionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $questions = Questions::where('user_id', '=', 1)->orWhere('user_id', '=', Auth::id())->paginate(10);
        return view('data.questions.index', ['questions'=>$questions]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('data.questions.create');
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
            'question' => 'required',
            'type' => 'required',
        ]);

        $questions = new Questions;
        $questions->fill($request->all());
        $questions->status = 1;
        $questions->user_id = Auth::id();
        $questions->save();
        return redirect('/questions')->with('message','Pregunta Registrada Correctamente');
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
        $questions = Questions::find($id);
        return view('data.questions.edit', ['questions'=>$questions]);
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
            'question' => 'required',
            'type' => 'required',
        ]);

        $questions = Questions::find($id);
        $questions->fill($request->all());
        $questions->save();
        return redirect('/questions')->with('message','Pregunta Actualizada Correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $surques = Surveys_Questions::where('question_id', '=', $id)->count();
        if($surques == 0)
        {
            $questions = Questions::find($id);
            $questions->delete();
            return redirect('/questions')->with('message','Pregunta Eliminada Correctamente');
        }
        else
        {
            return redirect('/questions')->with('message','No se puede eliminar la pregunta porque esta asignada a una encuesta');
        }
        
    }

    public function enable($id)
    {
        $question = Questions::find($id);
        $question->status = 1;
        $question->save();
        return redirect()->back();
    }

    public function disable($id)
    {
        $question = Questions::find($id);
        $question->status = 2;
        $question->save();
        return redirect()->back();
    }
}
