<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use Redirect;
use Charts;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;
use App\Surveys;
use App\Questions;
use App\Surveys_Questions;
use App\Answers;
use App\AnswersDetails;
use App\User;

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
        $suranswers = Answers::join('surveys', 'answers.survey_id', '=', 'surveys.id')->select('answers.id AS id', 'answers.name AS name', 'answers.email AS email', 'surveys.id as surid')->where('surveys.id', '=', $id)->paginate(10);
        $questions = Surveys_Questions::join('questions', 'surveys_questions.question_id', '=', 'questions.id')->join('surveys', 'surveys_questions.survey_id', '=', 'surveys.id')->select('questions.question AS name', 'questions.id as qid', 'questions.type as type', 'surveys_questions.position as position')->where('surveys.id', '=', $id)->get();
        $answersdet =  AnswersDetails::join('questions', 'answers_details.question_id', '=', 'questions.id')->select('answers_details.id AS id', 'answers_details.answer AS answer', 'answers_details.survey_id AS survey', 'answers_details.answer_id AS ansid', 'answers_details.comment As comment', 'questions.id as qid')->where('answers_details.survey_id', '=', $id)->get();

        $survey = Surveys::find($id);
        $si = AnswersDetails::where('survey_id', '=', $id)->where('answer', '=', '1')->count();
        $no = AnswersDetails::where('survey_id', '=', $id)->where('answer', '=', '2')->count();
        $malo = AnswersDetails::where('survey_id', '=', $id)->where('answer', '=', '3')->count();
        $regular = AnswersDetails::where('survey_id', '=', $id)->where('answer', '=', '4')->count();
        $bueno = AnswersDetails::where('survey_id', '=', $id)->where('answer', '=', '5')->count();
        $excelente = AnswersDetails::where('survey_id', '=', $id)->where('answer', '=', '6')->count();

        $chart = Charts::create('pie', 'fusioncharts')
          ->title('Encuesta: '.$survey->name)
          ->colors(['#1610c5', '#c51010', '#bf331a', '#d9e330', '#2bb426', '#7185ea'])
          ->labels(['Si', 'No', 'Malo', 'Regular', 'Bueno', 'Excelente'])
          ->values([$si, $no, $malo, $regular, $bueno, $excelente])
          ->dimensions(1000,500)
          ->responsive(false);

        $i = 0;
        $j = 0;
        foreach($questions as $q)
        {
            if($q->type == 1)
            {
                $si2[$i] = AnswersDetails::where('survey_id', '=', $id)->where('answer', '=', '1')->where('question_id', '=', $q->qid)->count();
                $no2[$i] = AnswersDetails::where('survey_id', '=', $id)->where('answer', '=', '2')->where('question_id', '=', $q->qid)->count();

                $chart2[] = Charts::create('pie', 'highcharts')
                    ->title('Pregunta #'.$q->position.': '.$q->name)
                    ->labels(['Si', 'No'])
                    ->values([$si2[$i], $no2[$i]])
                    ->dimensions(1000,500)
                    ->responsive(false);
                $i++;
            }
            elseif($q->type == 2)
            {

                $malo2[$j] = AnswersDetails::where('survey_id', '=', $id)->where('answer', '=', '3')->where('question_id', '=', $q->qid)->count();
                $regular2[$j] = AnswersDetails::where('survey_id', '=', $id)->where('answer', '=', '4')->where('question_id', '=', $q->qid)->count();
                $bueno2[$j] = AnswersDetails::where('survey_id', '=', $id)->where('answer', '=', '5')->where('question_id', '=', $q->qid)->count();
                $excelente2[$j] = AnswersDetails::where('survey_id', '=', $id)->where('answer', '=', '6')->where('question_id', '=', $q->qid)->count();

                $chart2[] = Charts::create('pie', 'highcharts')
                    ->title('Pregunta #'.$q->position.': '.$q->name)
                    ->labels(['Malo', 'Regular', 'Bueno', 'Excelente'])
                    ->values([$malo2[$j], $regular2[$j], $bueno2[$j], $excelente2[$j]])
                    ->dimensions(1000,500)
                    ->responsive(false);
            }
        }
        return view('data.surveys.graphs', ['chart' => $chart, 'suranswers' => $suranswers, 'questions' => $questions, 'answersdet' => $answersdet, 'chart2' => $chart2]);
    }

    public function graphsdetails($id)
    {
        $answersdet = AnswersDetails::join('questions', 'answers_details.question_id', '=', 'questions.id')->join('surveys', 'answers_details.survey_id', '=', 'surveys.id')->select('answers_details.id AS id', 'answers_details.answer AS answer', 'answers_details.survey_id AS surid', 'surveys.name AS surname', 'questions.id AS questid')->where('answers_details.survey_id', '=', $id)->get();

        $questions = Surveys_Questions::join('questions', 'surveys_questions.question_id', '=', 'questions.id')->join('surveys', 'surveys_questions.survey_id', '=', 'surveys.id')->select('questions.question AS name')->where('surveys.id', '=', $id)->get();

        $quest = AnswersDetails::join('questions', 'answers_details.question_id', '=', 'questions.id')->join('surveys', 'answers_details.survey_id', '=', 'surveys.id')->select('answers_details.id AS id', 'answers_details.answer AS answer', 'answers_details.survey_id AS surid')->where('answers_details.survey_id', '=', $id)->count();

        return view('data.surveys.graphs');
    }
}
