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
use Khill\Lavacharts\Lavacharts;

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
        $s = Surveys::where('user_id', '=', Auth::id())->count();
        return view('data.surveys.index', ['surveys'=>$surveys, 's'=>$s]);
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

        $s = Surveys::where('user_id', '=', Auth::id())->count();

        if($s < Auth::user()->branch)
        {
            $surveys = new Surveys;
            $surveys->fill($request->all());
            $surveys->user_id = Auth::id();
            $surveys->save();
            return redirect('/surveys/'.$surveys->id.'/questions')->with('message','Encuesta Registrada Correctamente');
        }
        elseif($s == Auth::user()->branch)
        {
            return redirect('/surveys')->with('error','Has superado el limite de encuestas que puedes crear');
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
        $count = Surveys_Questions::join('questions', 'surveys_questions.question_id', '=', 'questions.id')->select('surveys_questions.id AS id', 'questions.question AS question', 'surveys_questions.position AS position')->where('surveys_questions.survey_id', '=', $id)->count();

        if(isset($last))
        {
            $last = $last->position;
        }
        else
        {
            $last = 0;
        }
        
        return view('data.surveys.questions', ['surveys'=>$surveys, 'surquestions'=>$surquestions, 'questions'=>$questions, 'last'=>$last, 'count'=>$count]);
    }

    public function survey($id)
    {
        $surveys = Surveys::find($id);
        $surquestions = Surveys_Questions::join('questions', 'surveys_questions.question_id', '=', 'questions.id')->select('surveys_questions.id AS id', 'questions.id AS question_id', 'questions.question AS question', 'surveys_questions.position AS position', 'questions.type AS type')->where('surveys_questions.survey_id', '=', $id)->get();
        return view('pages.survey', ['surveys'=>$surveys, 'surquestions'=>$surquestions]);
    }

    public function links($id)
    {
        $survey = Surveys::find($id);
        return view('data.surveys.links', ['survey'=>$survey]);
    }

    public function suranswers($id)
    {
        $suranswers = Answers::join('surveys', 'answers.survey_id', '=', 'surveys.id')->select('answers.id AS id', 'answers.name AS name', 'answers.email AS email', 'surveys.id as surid')->where('surveys.id', '=', $id)->paginate(10);
        $questions = Surveys_Questions::join('questions', 'surveys_questions.question_id', '=', 'questions.id')->join('surveys', 'surveys_questions.survey_id', '=', 'surveys.id')->select('questions.question AS name')->where('surveys.id', '=', $id)->get();
        $answersdet =  AnswersDetails::join('questions', 'answers_details.question_id', '=', 'questions.id')->select('answers_details.id AS id', 'answers_details.answer AS answer', 'answers_details.survey_id AS survey', 'answers_details.answer_id AS ansid', 'answers_details.comment As comment')->where('answers_details.survey_id', '=', $id)->get();

        return view('data.surveys.answers', ['suranswers'=>$suranswers, 'questions'=>$questions, 'answersdet'=>$answersdet]);
    }

    public function graphs($id)
    {
        $answersdet = AnswersDetails::join('surveys', 'answers_details.survey_id', '=', 'surveys.id')->select('answers_details.id AS id', 'answers_details.answer AS answer', 'answers_details.survey_id AS surid')->where('answers_details.survey_id', '=', $id)->get();

        $count = AnswersDetails::join('questions', 'answers_details.question_id', '=', 'questions.id')->join('surveys', 'answers_details.survey_id', '=', 'surveys.id')->select('answers_details.id AS id', 'answers_details.answer AS answer', 'answers_details.survey_id AS surid')->where('answers_details.survey_id', '=', $id)->count();

        $pos = Surveys_Questions::join('questions', 'surveys_questions.question_id', '=', 'questions.id')->join('surveys', 'surveys_questions.survey_id', '=', 'surveys.id')->select('questions.id as id', 'surveys_questions.position AS pos')->where('surveys_questions.survey_id', '=', $id)->get();

        $surveys = Surveys::find($id);

        $a1 = 0;
        $a2 = 0;
        $a3 = 0;
        $a4 = 0;
        $a5 = 0;

        $lava = new Lavacharts();

        $table = $lava->DataTable();

        $table->addStringColumn('Respuestas')
              ->addNumberColumn('Porcentaje');

        foreach($answersdet as $a)
        {
            $answer1 = AnswersDetails::where('survey_id','=', $id)->where('answer', '=', 1)->count();
            $answer2 = AnswersDetails::where('survey_id','=', $id)->where('answer', '=', 2)->count();
            $answer3 = AnswersDetails::where('survey_id','=', $id)->where('answer', '=', 3)->count();
            $answer4 = AnswersDetails::where('survey_id','=', $id)->where('answer', '=', 4)->count();
            $answer5 = AnswersDetails::where('survey_id','=', $id)->where('answer', '=', 5)->count();
            
            $a1 = $a1 + $answer1;
            $a2 = $a2 + $answer2;
            $a3 = $a3 + $answer3;
            $a4 = $a4 + $answer4;
            $a5 = $a5 + $answer5;

        }
        return $a1;
        $table->addRow(['Muy Mala', $a1])->addRow(['Mala', $a2])->addRow(['Regular', $a3])->addRow(['Buena', $a4])->addRow(['Muy Buena', $a5]);

        $lava->PieChart('Encuesta',$table);

        return view('data.surveys.graphs', compact('lava'));
    }

    public function graphsdetails($id)
    {
        $answersdet = AnswersDetails::join('questions', 'answers_details.question_id', '=', 'questions.id')->join('surveys', 'answers_details.survey_id', '=', 'surveys.id')->select('answers_details.id AS id', 'answers_details.answer AS answer', 'answers_details.survey_id AS surid', 'surveys.name AS surname', 'questions.id AS questid')->where('answers_details.survey_id', '=', $id)->get();

        $questions = Surveys_Questions::join('questions', 'surveys_questions.question_id', '=', 'questions.id')->join('surveys', 'surveys_questions.survey_id', '=', 'surveys.id')->select('questions.question AS name')->where('surveys.id', '=', $id)->get();

        $quest = AnswersDetails::join('questions', 'answers_details.question_id', '=', 'questions.id')->join('surveys', 'answers_details.survey_id', '=', 'surveys.id')->select('answers_details.id AS id', 'answers_details.answer AS answer', 'answers_details.survey_id AS surid')->where('answers_details.survey_id', '=', $id)->count();

        $a1 = 0;
        $a2 = 0;
        $a3 = 0;
        $a4 = 0;
        $a5 = 0;
        
        foreach($answersdet as $a)
        {
            $answer1 = AnswersDetails::where('survey_id','=', $id)->where('question_id', '=', $a->questid)->where('answer', '=', 1)->count();
            $answer2 = AnswersDetails::where('survey_id','=', $id)->where('question_id', '=', $a->questid)->where('answer', '=', 2)->count();
            $answer3 = AnswersDetails::where('survey_id','=', $id)->where('question_id', '=', $a->questid)->where('answer', '=', 3)->count();
            $answer4 = AnswersDetails::where('survey_id','=', $id)->where('question_id', '=', $a->questid)->where('answer', '=', 4)->count();
            $answer5 = AnswersDetails::where('survey_id','=', $id)->where('question_id', '=', $a->questid)->where('answer', '=', 5)->count();
            
            $a1 = $a1 + $answer1;
            $a2 = $a2 + $answer2;
            $a3 = $a3 + $answer3;
            $a4 = $a4 + $answer4;
            $a5 = $a5 + $answer5;
        }

        $i = 0;

        while($i <= $quest)
        {
            $lava = new Lavacharts; // See note below for Laravel
            $reasons = $lava->DataTable();
            
            $reasons->addStringColumn('Respuestas')->addNumberColumn('Porcentaje')->addRow(['Muy Mala', $a1])->addRow(['Mala', $a2])->addRow(['Regular', $a3])->addRow(['Buena', $a4])->addRow(['Muy Buena', $a5]);

            $lava->PieChart($a->surname, $reasons, ['title'  => $a->surname, 'is3D' => true,'slices' => [['offset' => 0],['offset' => 0],['offset' => 0]]]);
           
            $i++;
        }

        return view('data.surveys.graphs', ['lava'=>$lava, 'answersdet'=>$answersdet]);
    }
}
