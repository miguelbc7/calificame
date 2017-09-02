<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use Redirect;
use Charts;
use DOMPDF;
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
            $surveys->date = date('Y-m-d');
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
        $surques = Surveys_Questions::where('survey_id', '=', $id)->delete();
        $answersdetails = AnswersDetails::where('survey_id', '=', $id)->delete();
        $answers = Answers::where('survey_id', '=', $id)->delete();
        $surveys = Surveys::find($id);
        $surveys->delete();
        return redirect('/surveys')->with('message','Encuesta Eliminada Correctamente');
    }

    public function back()
    {
        return Redirect::back();
    }

    public function questions($id)
    {
        $surveys = Surveys::find($id);
        $surquestions = Surveys_Questions::join('questions', 'surveys_questions.question_id', '=', 'questions.id')->select('surveys_questions.id AS id', 'questions.question AS question', 'surveys_questions.position AS position')->where('surveys_questions.survey_id', '=', $id)->orderBy('position', 'asc')->paginate(10);
        $questions = Questions::where('user_id', '=', Auth::id())->orderBy('id')->pluck('question', 'id');
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
        if(isset($surveys))
        {
            $user = User::find($surveys->user_id);
        }
        else
        {
            $user = 0;
        }
        
        $surquestions = Surveys_Questions::join('questions', 'surveys_questions.question_id', '=', 'questions.id')->select('surveys_questions.id AS id', 'questions.id AS question_id', 'questions.question AS question', 'surveys_questions.position AS position', 'questions.type AS type')->where('surveys_questions.survey_id', '=', $id)->get();
        return view('pages.survey', ['surveys'=>$surveys, 'surquestions'=>$surquestions, 'user'=>$user]);
    }

    public function surveyFinish()
    {
        return view('pages.surveyFinish');
    }

    public function links($id)
    {
        $survey = Surveys::find($id);
        return view('data.surveys.links', ['survey'=>$survey]);
    }

    public function suranswers($id)
    {
        $suranswers = Answers::join('surveys', 'answers.survey_id', '=', 'surveys.id')->select('answers.id AS id', 'answers.name AS name', 'answers.email AS email', 'surveys.id as surid', 'answers.calification as calification')->where('surveys.id', '=', $id)->paginate(10);
        $questions = Surveys_Questions::join('questions', 'surveys_questions.question_id', '=', 'questions.id')->join('surveys', 'surveys_questions.survey_id', '=', 'surveys.id')->select('questions.question AS name')->where('surveys.id', '=', $id)->get();
        $answersdet =  AnswersDetails::join('questions', 'answers_details.question_id', '=', 'questions.id')->select('answers_details.id AS id', 'answers_details.answer AS answer', 'answers_details.survey_id AS survey', 'answers_details.answer_id AS ansid', 'answers_details.comment As comment')->where('answers_details.survey_id', '=', $id)->get();

        return view('data.surveys.answers', ['suranswers'=>$suranswers, 'questions'=>$questions, 'answersdet'=>$answersdet]);
    }

    public function pregraphs($id)
    {
        $surveys = Surveys::find($id);
        return view('data.surveys.pregraphs', ['surveys'=>$surveys]);
    }

    public function graphsQuestions($id)
    {

        $suranswers = Answers::join('surveys', 'answers.survey_id', '=', 'surveys.id')->select('answers.id AS id', 'answers.name AS name', 'answers.email AS email', 'surveys.id as surid')->where('surveys.id', '=', $id)->paginate(10);
        $questions = Surveys_Questions::join('questions', 'surveys_questions.question_id', '=', 'questions.id')->join('surveys', 'surveys_questions.survey_id', '=', 'surveys.id')->select('questions.question AS name', 'questions.id as qid', 'questions.type as type', 'surveys_questions.position as position')->where('surveys.id', '=', $id)->get();
        $answersdet =  AnswersDetails::join('questions', 'answers_details.question_id', '=', 'questions.id')->select('answers_details.id AS id', 'answers_details.answer AS answer', 'answers_details.survey_id AS survey', 'answers_details.answer_id AS ansid', 'answers_details.comment As comment', 'questions.id as qid')->where('answers_details.survey_id', '=', $id)->get();

        Session::put('surid', $id);
        $survey = Surveys::find($id);

        $i = 0;
        $j = 0;
        foreach($questions as $q)
        {
            if($q->type == 1)
            {
                $count[$i] = AnswersDetails::where('survey_id', '=', $id)->where('question_id', '=', $q->qid)->whereIn('answer', [1, 2])->count();
                $si2[$i] = AnswersDetails::where('survey_id', '=', $id)->where('answer', '=', '1')->where('question_id', '=', $q->qid)->count();
                $no2[$i] = AnswersDetails::where('survey_id', '=', $id)->where('answer', '=', '2')->where('question_id', '=', $q->qid)->count();

                $subPercentSi[$i] = $si2[$i]/$count[$i];
                $percentSi[$i] = $subPercentSi[$i]*100;

                $subPercentNo[$i] = $no2[$i]/$count[$i];
                $percentNo[$i] = $subPercentNo[$i]*100;

                if($si2[$i] == 1)
                {
                    $s2[$i] = 'Si '.$percentSi[$i].'% ('.$si2[$i].' respuesta)';
                }
                else
                {
                    $s2[$i] = 'Si '.$percentSi[$i].'% ('.$si2[$i].' respuestas)';
                }
                 
                if($no2[$i] == 1)
                {
                    $n2[$i] = 'No '.$percentNo[$i].'% ('.$no2[$i].' respuesta)';
                }
                else
                {
                    $n2[$i] = 'No '.$percentNo[$i].' %('.$no2[$i].' respuestas)';
                }

                if(isset($dateOne) && isset($dateTwo))
                {
                    $name = $q->name.'<br>Desde: '. $dateOne . ' - Hasta: ' .$dateTwo;
                }
                else
                {
                    $name = $q->name.'<br>Fecha: '. date('d-m-Y');
                }

                $chart2[] = Charts::create('pie', 'fusioncharts')
                    ->title($name)
                    ->colors(['#c51010', '#1610c5'])
                    ->labels([$n2[$i], $s2[$i]])
                    ->values([$no2[$i], $si2[$i]])
                    ->dimensions(1000,500)
                    ->responsive(false);
                $i++;
            }
            elseif($q->type == 2)
            {
                $count[$j] = AnswersDetails::where('survey_id', '=', $id)->where('question_id', '=', $q->qid)->whereIn('answer', [3,4,5,6])->count();
                $malo2[$j] = AnswersDetails::where('survey_id', '=', $id)->where('answer', '=', '3')->where('question_id', '=', $q->qid)->count();
                $regular2[$j] = AnswersDetails::where('survey_id', '=', $id)->where('answer', '=', '4')->where('question_id', '=', $q->qid)->count();
                $bueno2[$j] = AnswersDetails::where('survey_id', '=', $id)->where('answer', '=', '5')->where('question_id', '=', $q->qid)->count();
                $excelente2[$j] = AnswersDetails::where('survey_id', '=', $id)->where('answer', '=', '6')->where('question_id', '=', $q->qid)->count();

                $subPercentMalo[$j] = $malo2[$j]/$count[$j];
                $percentMalo[$j] = $subPercentMalo[$j]*100;

                $subPercentRegular[$j] = $regular2[$j]/$count[$j];
                $percentRegular[$j] = $subPercentRegular[$j]*100;

                $subPercentBueno[$j] = $bueno2[$j]/$count[$j];
                $percentBueno[$j] = $subPercentBueno[$j]*100;

                $subPercentExcelente[$j] = $excelente2[$j]/$count[$j];
                $percentExcelente[$j] = $subPercentExcelente[$j]*100;

                if($malo2[$j] == 1)
                {
                    $m2[$j] = 'Malo '.$percentMalo[$j].'% ('.$malo2[$j].' respuesta)';
                }
                else
                {
                    $m2[$j] = 'Malo '.$percentMalo[$j].'% ('.$malo2[$j].' respuestas)';
                }

                if($regular2[$j] == 1)
                {
                    $r2[$j] = 'Regular '.$percentRegular[$j].'% ('.$regular2[$j].' respuesta)';
                }
                else
                {
                    $r2[$j] = 'Regular '.$percentRegular[$j].'% ('.$regular2[$j].' respuestas)';
                }

                if($bueno2[$j] == 1)
                {
                    $b2[$j] = 'Bueno '.$percentBueno[$j].'% ('.$bueno2[$j].' respuesta)';
                }
                else
                {
                    $b2[$j] = 'Bueno '.$percentBueno[$j].'% ('.$bueno2[$j].' respuestas)';
                }

                if($excelente2[$j] == 1)
                {
                    $e2[$j] = 'Excelente '.$percentExcelente[$j].'% ('.$excelente2[$j].' respuesta)';
                }
                else
                {
                    $e2[$j] = 'Excelente '.$percentExcelente[$j].'% ('.$excelente2[$j].' respuestas)';
                }

                if(isset($dateOne) && isset($dateTwo))
                {
                    $name = $q->name.'<br>Desde: '. $dateOne . ' - Hasta: ' .$dateTwo;
                }
                else
                {
                    $name = $q->name.'<br>Fecha: '. date('d-m-Y');
                }

                $chart2[] = Charts::create('pie', 'fusioncharts')
                    ->title($name)
                    ->colors(['#7185ea', '#2bb426', '#d9e330', '#bf331a'])
                    ->labels([$e2[$j], $b2[$j], $r2[$j], $m2[$j]])
                    ->values([$excelente2[$j], $bueno2[$j], $regular2[$j], $malo2[$j]])
                    ->dimensions(1000,500)
                    ->responsive(false);
                $j++;
            }
        }
        return view('data.surveys.graphs', ['suranswers' => $suranswers, 'questions' => $questions, 'answersdet' => $answersdet, 'chart2' => $chart2, 'survey' => $survey]);
    }

    public function graphsSatisfaction($id)
    {
        $suranswers = Answers::join('surveys', 'answers.survey_id', '=', 'surveys.id')->select('answers.id AS id', 'answers.name AS name', 'answers.email AS email', 'surveys.id as surid')->where('surveys.id', '=', $id)->paginate(10);
        $questions = Surveys_Questions::join('questions', 'surveys_questions.question_id', '=', 'questions.id')->join('surveys', 'surveys_questions.survey_id', '=', 'surveys.id')->select('questions.question AS name', 'questions.id as qid', 'questions.type as type', 'surveys_questions.position as position')->where('surveys.id', '=', $id)->get();
        $answersdet =  AnswersDetails::join('questions', 'answers_details.question_id', '=', 'questions.id')->select('answers_details.id AS id', 'answers_details.answer AS answer', 'answers_details.survey_id AS survey', 'answers_details.answer_id AS ansid', 'answers_details.comment As comment', 'questions.id as qid')->where('answers_details.survey_id', '=', $id)->get();

        $survey = Surveys::find($id);

        $i = 0;
        $j = 0;
        foreach($questions as $q)
        {
            if($q->type == 1)
            {
                $count[$i] = AnswersDetails::where('survey_id', '=', $id)->where('question_id', '=', $q->qid)->whereIn('answer', [1, 2])->count();
                $satisfecho2[$i] = AnswersDetails::where('survey_id', '=', $id)->where('answer', '=', '1')->where('question_id', '=', $q->qid)->count();
                $insatisfecho2[$i] = AnswersDetails::where('survey_id', '=', $id)->where('answer', '=', '2')->where('question_id', '=', $q->qid)->count();

                $subPercentSas[$i] = $satisfecho2[$i]/$count[$i];
                $percentSas[$i] = $subPercentSas[$i]*100;

                $subPercentInsas[$i] = $insatisfecho2[$i]/$count[$i];
                $percentInsas[$i] = $subPercentInsas[$i]*100;

                if($satisfecho2[$i] == 1)
                {
                    $s2[$i] = 'Satisfecho '.$percentSas[$i].'% ('.$satisfecho2[$i].' respuesta)';
                }
                else
                {
                    $s2[$i] = 'Satisfecho '.$percentSas[$i].'% ('.$satisfecho2[$i].' respuestas)';
                }
                 
                if($insatisfecho2[$i] == 1)
                {
                    $i2[$i] = 'Insatisfecho '.$percentInsas[$i].'% ('.$insatisfecho2[$i].' respuesta)';
                }
                else
                {
                    $i2[$i] = 'Insatisfecho '.$percentInsas[$i].'% ('.$insatisfecho2[$i].' respuestas)';
                }

                if(isset($dateOne) && isset($dateTwo))
                {
                    $name = $q->name.'<br>Desde: '. $dateOne . ' - Hasta: ' .$dateTwo;
                }
                else
                {
                    $name = $q->name.'<br>Fecha: '. date('d-m-Y');
                }

                $chart2[] = Charts::create('pie', 'fusioncharts')
                    ->title($name)
                    ->colors(['#1610c5', '#c51010'])
                    ->labels([$s2[$i], $i2[$i]])
                    ->values([$satisfecho2[$i], $insatisfecho2[$i]])
                    ->dimensions(1000,500)
                    ->responsive(false);
                $i++;
            }
            elseif($q->type == 2)
            {
                $count[$j] = AnswersDetails::where('survey_id', '=', $id)->where('question_id', '=', $q->qid)->whereIn('answer', [3,4,5,6])->count();
                $satisfecho2[$j] = AnswersDetails::where('survey_id', '=', $id)->where('question_id', '=', $q->qid)->whereIn('answer', [5, 6])->count();
                $insatisfecho2[$j] = AnswersDetails::where('survey_id', '=', $id)->where('question_id', '=', $q->qid)->whereIn('answer', [3, 4])->count();

                $subPercentSas[$j] = $satisfecho2[$j]/$count[$j];
                $percentSas[$j] = $subPercentSas[$j]*100;

                $subPercentInsas[$j] = $insatisfecho2[$j]/$count[$j];
                $percentInsas[$j] = $subPercentInsas[$j]*100;

                if($satisfecho2[$j] == 1)
                {
                    $s2[$j] = 'Satisfecho '.$percentSas[$j].'% ('.$satisfecho2[$j].' respuesta)';
                }
                else
                {
                    $s2[$j] = 'Satisfecho '.$percentSas[$j].'% ('.$satisfecho2[$j].' respuestas)';
                }
                 
                if($insatisfecho2[$j] == 1)
                {
                    $i2[$j] = 'Insatisfecho '.$percentInsas[$j].'% ('.$insatisfecho2[$j].' respuesta)';
                }
                else
                {
                    $i2[$j] = 'Insatisfecho '.$percentInsas[$j].'% ('.$insatisfecho2[$j].' respuestas)';
                }

                if(isset($dateOne) && isset($dateTwo))
                {
                    $name = $q->name.'<br>Desde: '. $dateOne . ' - Hasta: ' .$dateTwo;
                }
                else
                {
                    $name = $q->name.'<br>Fecha: '. date('d-m-Y');
                }

                $chart2[] = Charts::create('pie', 'fusioncharts')
                    ->title($name)
                    ->colors(['#1610c5', '#c51010'])
                    ->labels([$s2[$j], $i2[$j]])
                    ->values([$satisfecho2[$j], $insatisfecho2[$j]])
                    ->dimensions(1000,500)
                    ->responsive(false);
                $j++;
            }
        }
        return view('data.surveys.graphs', ['suranswers' => $suranswers, 'questions' => $questions, 'answersdet' => $answersdet, 'chart2' => $chart2, 'survey' => $survey]);
    }

    public function graphsDateQuestions(Request $request, $id)
    {
        $this->validate($request, [
            'dateOne' => 'required|date',
            'dateTwo' => 'required|date'
        ]);

        $suranswers = Answers::join('surveys', 'answers.survey_id', '=', 'surveys.id')->select('answers.id AS id', 'answers.name AS name', 'answers.email AS email', 'surveys.id as surid')->where('surveys.id', '=', $id)->paginate(10);
        $questions = Surveys_Questions::join('questions', 'surveys_questions.question_id', '=', 'questions.id')->join('surveys', 'surveys_questions.survey_id', '=', 'surveys.id')->select('questions.question AS name', 'questions.id as qid', 'questions.type as type', 'surveys_questions.position as position')->where('surveys.id', '=', $id)->get();
        $answersdet =  AnswersDetails::join('questions', 'answers_details.question_id', '=', 'questions.id')->select('answers_details.id AS id', 'answers_details.answer AS answer', 'answers_details.survey_id AS survey', 'answers_details.answer_id AS ansid', 'answers_details.comment As comment', 'questions.id as qid')->where('answers_details.survey_id', '=', $id)->get();

        $survey = Surveys::find($id);

        $i = 0;
        $j = 0;
        
        $dateOne = date("d-m-Y", strtotime($request->dateOne));
        $dateTwo = date("d-m-Y", strtotime($request->dateTwo));

        foreach($questions as $q)
        {
            if($q->type == 1)
            {
                $count[$i] = AnswersDetails::where('survey_id', '=', $id)->where('question_id', '=', $q->qid)->whereIn('answer', [1, 2])->whereBetween('date', [$request->dateOne, $request->dateTwo])->count();
                $si2[$i] = AnswersDetails::where('survey_id', '=', $id)->where('answer', '=', '1')->where('question_id', '=', $q->qid)->whereBetween('date', [$request->dateOne, $request->dateTwo])->count();
                $no2[$i] = AnswersDetails::where('survey_id', '=', $id)->where('answer', '=', '2')->where('question_id', '=', $q->qid)->whereBetween('date', [$request->dateOne, $request->dateTwo])->count();

                $subPercentSi[$i] = $si2[$i]/$count[$i];
                $percentSi[$i] = $subPercentSi[$i]*100;

                $subPercentNo[$i] = $no2[$i]/$count[$i];
                $percentNo[$i] = $subPercentNo[$i]*100;

                if($si2[$i] == 1)
                {
                    $s2[$i] = 'Si '.$percentSi[$i].'% ('.$si2[$i].' respuesta)';
                }
                else
                {
                    $s2[$i] = 'Si '.$percentSi[$i].'% ('.$si2[$i].' respuestas)';
                }
                 
                if($no2[$i] == 1)
                {
                    $n2[$i] = 'No '.$percentNo[$i].'% ('.$no2[$i].' respuesta)';
                }
                else
                {
                    $n2[$i] = 'No '.$percentNo[$i].' %('.$no2[$i].' respuestas)';
                }

                if(isset($dateOne) && isset($dateTwo))
                {
                    $name = $q->name.'<br>Desde: '. $dateOne . ' - Hasta: ' .$dateTwo;
                }
                else
                {
                    $name = $q->name.'<br>Fecha: '. date('d-m-Y');
                }

                $chart2[] = Charts::create('pie', 'fusioncharts')
                    ->title($name)
                    ->colors(['#c51010', '#1610c5'])
                    ->labels([$n2[$i], $s2[$i]])
                    ->values([$no2[$i], $si2[$i]])
                    ->dimensions(1000,500)
                    ->responsive(false);
                $i++;
            }
            elseif($q->type == 2)
            {
                $count[$j] = AnswersDetails::where('survey_id', '=', $id)->where('question_id', '=', $q->qid)->whereIn('answer', [3,4,5,6])->whereBetween('date', [$request->dateOne, $request->dateTwo])->count();
                $malo2[$j] = AnswersDetails::where('survey_id', '=', $id)->where('answer', '=', '3')->where('question_id', '=', $q->qid)->whereBetween('date', [$request->dateOne, $request->dateTwo])->count();
                $regular2[$j] = AnswersDetails::where('survey_id', '=', $id)->where('answer', '=', '4')->where('question_id', '=', $q->qid)->whereBetween('date', [$request->dateOne, $request->dateTwo])->count();
                $bueno2[$j] = AnswersDetails::where('survey_id', '=', $id)->where('answer', '=', '5')->where('question_id', '=', $q->qid)->whereBetween('date', [$request->dateOne, $request->dateTwo])->count();
                $excelente2[$j] = AnswersDetails::where('survey_id', '=', $id)->where('answer', '=', '6')->where('question_id', '=', $q->qid)->whereBetween('date', [$request->dateOne, $request->dateTwo])->count();

                $subPercentMalo[$j] = $malo2[$j]/$count[$j];
                $percentMalo[$j] = $subPercentMalo[$j]*100;

                $subPercentRegular[$j] = $regular2[$j]/$count[$j];
                $percentRegular[$j] = $subPercentRegular[$j]*100;

                $subPercentBueno[$j] = $bueno2[$j]/$count[$j];
                $percentBueno[$j] = $subPercentBueno[$j]*100;

                $subPercentExcelente[$j] = $excelente2[$j]/$count[$j];
                $percentExcelente[$j] = $subPercentExcelente[$j]*100;

                if($malo2[$j] == 1)
                {
                    $m2[$j] = 'Malo '.$percentMalo[$j].'% ('.$malo2[$j].' respuesta)';
                }
                else
                {
                    $m2[$j] = 'Malo '.$percentMalo[$j].'% ('.$malo2[$j].' respuestas)';
                }

                if($regular2[$j] == 1)
                {
                    $r2[$j] = 'Regular '.$percentRegular[$j].'% ('.$regular2[$j].' respuesta)';
                }
                else
                {
                    $r2[$j] = 'Regular '.$percentRegular[$j].'% ('.$regular2[$j].' respuestas)';
                }

                if($bueno2[$j] == 1)
                {
                    $b2[$j] = 'Bueno '.$percentBueno[$j].'% ('.$bueno2[$j].' respuesta)';
                }
                else
                {
                    $b2[$j] = 'Bueno '.$percentBueno[$j].'% ('.$bueno2[$j].' respuestas)';
                }

                if($excelente2[$j] == 1)
                {
                    $e2[$j] = 'Excelente '.$percentExcelente[$j].'% ('.$excelente2[$j].' respuesta)';
                }
                else
                {
                    $e2[$j] = 'Excelente '.$percentExcelente[$j].'% ('.$excelente2[$j].' respuestas)';
                }

                if(isset($dateOne) && isset($dateTwo))
                {
                    $name = $q->name.'<br>Desde: '. $dateOne . ' - Hasta: ' .$dateTwo;
                }
                else
                {
                    $name = $q->name.'<br>Fecha: '. date('d-m-Y');
                }

                $chart2[] = Charts::create('pie', 'fusioncharts')
                    ->title($name)
                    ->colors(['#7185ea', '#2bb426', '#d9e330', '#bf331a'])
                    ->labels([$e2[$j], $b2[$j], $r2[$j], $m2[$j]])
                    ->values([$excelente2[$j], $bueno2[$j], $regular2[$j], $malo2[$j]])
                    ->dimensions(1000,500)
                    ->responsive(false);
                $j++;
            }
        }
        return view('data.surveys.graphs', ['suranswers' => $suranswers, 'questions' => $questions, 'answersdet' => $answersdet, 'chart2' => $chart2, 'survey' => $survey, 'dateOne' => $dateOne, 'dateTwo' => $dateTwo]);
    }

    public function graphsDateSatisfaction(Request $request, $id)
    {

        $this->validate($request, [
            'dateOne' => 'required|date',
            'dateTwo' => 'required|date'
        ]);
        $suranswers = Answers::join('surveys', 'answers.survey_id', '=', 'surveys.id')->select('answers.id AS id', 'answers.name AS name', 'answers.email AS email', 'surveys.id as surid')->where('surveys.id', '=', $id)->paginate(10);
        $questions = Surveys_Questions::join('questions', 'surveys_questions.question_id', '=', 'questions.id')->join('surveys', 'surveys_questions.survey_id', '=', 'surveys.id')->select('questions.question AS name', 'questions.id as qid', 'questions.type as type', 'surveys_questions.position as position')->where('surveys.id', '=', $id)->get();
        $answersdet =  AnswersDetails::join('questions', 'answers_details.question_id', '=', 'questions.id')->select('answers_details.id AS id', 'answers_details.answer AS answer', 'answers_details.survey_id AS survey', 'answers_details.answer_id AS ansid', 'answers_details.comment As comment', 'questions.id as qid')->where('answers_details.survey_id', '=', $id)->get();

        $survey = Surveys::find($id);

        $i = 0;
        $j = 0;

        $dateOne = $request->dateOne;
        $dateTwo = $request->dateTwo;

        foreach($questions as $q)
        {
            if($q->type == 1)
            {
                $count[$i] = AnswersDetails::where('survey_id', '=', $id)->where('question_id', '=', $q->qid)->whereIn('answer', [1, 2])->whereBetween('date', [$request->dateOne, $request->dateTwo])->count();
                $satisfecho2[$i] = AnswersDetails::where('survey_id', '=', $id)->where('answer', '=', '1')->where('question_id', '=', $q->qid)->whereBetween('date', [$request->dateOne, $request->dateTwo])->count();
                $insatisfecho2[$i] = AnswersDetails::where('survey_id', '=', $id)->where('answer', '=', '2')->where('question_id', '=', $q->qid)->whereBetween('date', [$request->dateOne, $request->dateTwo])->count();

                $subPercentSas[$i] = $satisfecho2[$i]/$count[$i];
                $percentSas[$i] = $subPercentSas[$i]*100;

                $subPercentInsas[$i] = $insatisfecho2[$i]/$count[$i];
                $percentInsas[$i] = $subPercentInsas[$i]*100;

                if($satisfecho2[$i] == 1)
                {
                    $s2[$i] = 'Satisfecho '.$percentSas[$i].'% ('.$satisfecho2[$i].' respuesta)';
                }
                else
                {
                    $s2[$i] = 'Satisfecho '.$percentSas[$i].'% ('.$satisfecho2[$i].' respuestas)';
                }
                 
                if($insatisfecho2[$i] == 1)
                {
                    $i2[$i] = 'Insatisfecho '.$percentInsas[$i].'% ('.$insatisfecho2[$i].' respuesta)';
                }
                else
                {
                    $i2[$i] = 'Insatisfecho '.$percentInsas[$i].'% ('.$insatisfecho2[$i].' respuestas)';
                }

                if(isset($dateOne) && isset($dateTwo))
                {
                    $name = $q->name.'<br>Desde: '. $dateOne . ' - Hasta: ' .$dateTwo;
                }
                else
                {
                    $name = $q->name.'<br>Fecha: '. date('d-m-Y');
                }

                $chart2[] = Charts::create('pie', 'fusioncharts')
                    ->title($name)
                    ->colors(['#1610c5', '#c51010'])
                    ->labels([$s2[$i], $i2[$i]])
                    ->values([$satisfecho2[$i], $insatisfecho2[$i]])
                    ->dimensions(1000,500)
                    ->responsive(false);
                $i++;
            }
            elseif($q->type == 2)
            {
                $count[$j] = AnswersDetails::where('survey_id', '=', $id)->where('question_id', '=', $q->qid)->whereIn('answer', [3,4,5,6])->whereBetween('date', [$request->dateOne, $request->dateTwo])->count();
                $satisfecho2[$j] = AnswersDetails::where('survey_id', '=', $id)->where('question_id', '=', $q->qid)->whereIn('answer', [5, 6])->whereBetween('date', [$request->dateOne, $request->dateTwo])->count();
                $insatisfecho2[$j] = AnswersDetails::where('survey_id', '=', $id)->where('question_id', '=', $q->qid)->whereIn('answer', [3, 4])->whereBetween('date', [$request->dateOne, $request->dateTwo])->count();

                $subPercentSas[$j] = $satisfecho2[$j]/$count[$j];
                $percentSas[$j] = $subPercentSas[$j]*100;

                $subPercentInsas[$j] = $insatisfecho2[$j]/$count[$j];
                $percentInsas[$j] = $subPercentInsas[$j]*100;

                if($satisfecho2[$j] == 1)
                {
                    $s2[$j] = 'Satisfecho '.$percentSas[$j].'% ('.$satisfecho2[$j].' respuesta)';
                }
                else
                {
                    $s2[$j] = 'Satisfecho '.$percentSas[$j].'% ('.$satisfecho2[$j].' respuestas)';
                }
                 
                if($insatisfecho2[$j] == 1)
                {
                    $i2[$j] = 'Insatisfecho '.$percentInsas[$j].'% ('.$insatisfecho2[$j].' respuesta)';
                }
                else
                {
                    $i2[$j] = 'Insatisfecho '.$percentInsas[$j].'% ('.$insatisfecho2[$j].' respuestas)';
                }

                if(isset($dateOne) && isset($dateTwo))
                {
                    $name = $q->name.'<br>Desde: '. $dateOne . ' - Hasta: ' .$dateTwo;
                }
                else
                {
                    $name = $q->name.'<br>Fecha: '. date('d-m-Y');
                }

                $chart2[] = Charts::create('pie', 'fusioncharts')
                    ->title($name)
                    ->colors([ '#1610c5', '#c51010'])
                    ->labels([$s2[$j], $i2[$j]])
                    ->values([$satisfecho2[$j], $insatisfecho2[$j]])
                    ->dimensions(1000,500)
                    ->responsive(false);
                $j++;
            }
        }
        return view('data.surveys.graphs', ['suranswers' => $suranswers, 'questions' => $questions, 'answersdet' => $answersdet, 'chart2' => $chart2, 'survey' => $survey, 'dateOne' => $dateOne, 'dateTwo' => $dateTwo]);
    }

    public function pretrends($id)
    {
        $surveys = Surveys::find($id);
        return view('data.surveys.pretrends', ['surveys'=>$surveys]);
    }

    public function trendsQuestions($id)
    {

        $suranswers = Answers::join('surveys', 'answers.survey_id', '=', 'surveys.id')->select('answers.id AS id', 'answers.name AS name', 'answers.email AS email', 'surveys.id as surid')->where('surveys.id', '=', $id)->paginate(10);
        $questions = Surveys_Questions::join('questions', 'surveys_questions.question_id', '=', 'questions.id')->join('surveys', 'surveys_questions.survey_id', '=', 'surveys.id')->select('questions.question AS name', 'questions.id as qid', 'questions.type as type', 'surveys_questions.position as position')->where('surveys.id', '=', $id)->get();
        $answersdet =  AnswersDetails::join('questions', 'answers_details.question_id', '=', 'questions.id')->select('answers_details.id AS id', 'answers_details.answer AS answer', 'answers_details.survey_id AS survey', 'answers_details.answer_id AS ansid', 'answers_details.comment As comment', 'questions.id as qid')->where('answers_details.survey_id', '=', $id)->get();

        $survey = Surveys::find($id);
        $year = date('Y');

        $i = 0;
        $j = 0;
        foreach($questions as $q)
        {
            if($q->type == 1)
            {
                $si2Jan[$i] = AnswersDetails::where('survey_id', '=', $id)->where('answer', '=', '1')->where('question_id', '=', $q->qid)->whereBetween('date', [$year.'-01-01', $year.'-01-31'])->count();
                $si2Feb[$i] = AnswersDetails::where('survey_id', '=', $id)->where('answer', '=', '1')->where('question_id', '=', $q->qid)->whereBetween('date', [$year.'-02-01', $year.'-02-29'])->count();
                $si2Mar[$i] = AnswersDetails::where('survey_id', '=', $id)->where('answer', '=', '1')->where('question_id', '=', $q->qid)->whereBetween('date', [$year.'-03-01', $year.'-03-31'])->count();
                $si2Apr[$i] = AnswersDetails::where('survey_id', '=', $id)->where('answer', '=', '1')->where('question_id', '=', $q->qid)->whereBetween('date', [$year.'-04-01', $year.'-04-30'])->count();
                $si2May[$i] = AnswersDetails::where('survey_id', '=', $id)->where('answer', '=', '1')->where('question_id', '=', $q->qid)->whereBetween('date', [$year.'-05-01', $year.'-05-31'])->count();
                $si2Jun[$i] = AnswersDetails::where('survey_id', '=', $id)->where('answer', '=', '1')->where('question_id', '=', $q->qid)->whereBetween('date', [$year.'-06-01', $year.'-06-30'])->count();
                $si2Jul[$i] = AnswersDetails::where('survey_id', '=', $id)->where('answer', '=', '1')->where('question_id', '=', $q->qid)->whereBetween('date', [$year.'-07-01', $year.'-07-31'])->count();
                $si2Aug[$i] = AnswersDetails::where('survey_id', '=', $id)->where('answer', '=', '1')->where('question_id', '=', $q->qid)->whereBetween('date', [$year.'-08-01', $year.'-08-31'])->count();
                $si2Sep[$i] = AnswersDetails::where('survey_id', '=', $id)->where('answer', '=', '1')->where('question_id', '=', $q->qid)->whereBetween('date', [$year.'-09-01', $year.'-09-30'])->count();
                $si2Oct[$i] = AnswersDetails::where('survey_id', '=', $id)->where('answer', '=', '1')->where('question_id', '=', $q->qid)->whereBetween('date', [$year.'-10-01', $year.'-10-31'])->count();
                $si2Nov[$i] = AnswersDetails::where('survey_id', '=', $id)->where('answer', '=', '1')->where('question_id', '=', $q->qid)->whereBetween('date', [$year.'-11-01', $year.'-11-30'])->count();
                $si2Dec[$i] = AnswersDetails::where('survey_id', '=', $id)->where('answer', '=', '1')->where('question_id', '=', $q->qid)->whereBetween('date', [$year.'-12-01', $year.'-12-31'])->count();

                $no2Jan[$i] = AnswersDetails::where('survey_id', '=', $id)->where('answer', '=', '2')->where('question_id', '=', $q->qid)->whereBetween('date', [$year.'-01-01', $year.'-01-31'])->count();
                $no2Feb[$i] = AnswersDetails::where('survey_id', '=', $id)->where('answer', '=', '2')->where('question_id', '=', $q->qid)->whereBetween('date', [$year.'-02-01', $year.'-02-29'])->count();
                $no2Mar[$i] = AnswersDetails::where('survey_id', '=', $id)->where('answer', '=', '2')->where('question_id', '=', $q->qid)->whereBetween('date', [$year.'-03-01', $year.'-03-31'])->count();
                $no2Apr[$i] = AnswersDetails::where('survey_id', '=', $id)->where('answer', '=', '2')->where('question_id', '=', $q->qid)->whereBetween('date', [$year.'-04-01', $year.'-04-30'])->count();
                $no2May[$i] = AnswersDetails::where('survey_id', '=', $id)->where('answer', '=', '2')->where('question_id', '=', $q->qid)->whereBetween('date', [$year.'-05-01', $year.'-05-31'])->count();
                $no2Jun[$i] = AnswersDetails::where('survey_id', '=', $id)->where('answer', '=', '2')->where('question_id', '=', $q->qid)->whereBetween('date', [$year.'-06-01', $year.'-06-30'])->count();
                $no2Jul[$i] = AnswersDetails::where('survey_id', '=', $id)->where('answer', '=', '2')->where('question_id', '=', $q->qid)->whereBetween('date', [$year.'-07-01', $year.'-07-31'])->count();
                $no2Aug[$i] = AnswersDetails::where('survey_id', '=', $id)->where('answer', '=', '2')->where('question_id', '=', $q->qid)->whereBetween('date', [$year.'-08-01', $year.'-08-31'])->count();
                $no2Sep[$i] = AnswersDetails::where('survey_id', '=', $id)->where('answer', '=', '2')->where('question_id', '=', $q->qid)->whereBetween('date', [$year.'-09-01', $year.'-09-30'])->count();
                $no2Oct[$i] = AnswersDetails::where('survey_id', '=', $id)->where('answer', '=', '2')->where('question_id', '=', $q->qid)->whereBetween('date', [$year.'-10-01', $year.'-10-31'])->count();
                $no2Nov[$i] = AnswersDetails::where('survey_id', '=', $id)->where('answer', '=', '2')->where('question_id', '=', $q->qid)->whereBetween('date', [$year.'-11-01', $year.'-11-30'])->count();
                $no2Dec[$i] = AnswersDetails::where('survey_id', '=', $id)->where('answer', '=', '2')->where('question_id', '=', $q->qid)->whereBetween('date', [$year.'-12-01', $year.'-12-31'])->count();

                $chart2[] = Charts::multi('line', 'highcharts')
                    ->title($q->name)
                    ->colors(['#1610c5', '#c51010'])
                    ->labels(['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'])
                    ->dataset('Si', [$si2Jan[$i], $si2Feb[$i], $si2Mar[$i], $si2Apr[$i], $si2May[$i], $si2Jun[$i], $si2Jul[$i], $si2Aug[$i], $si2Sep[$i], $si2Oct[$i], $si2Nov[$i], $si2Dec[$i]])
                    ->dataset('No', [$no2Jan[$i], $no2Feb[$i], $no2Mar[$i], $no2Apr[$i], $no2May[$i], $no2Jun[$i], $no2Jul[$i], $no2Aug[$i], $no2Sep[$i], $no2Oct[$i], $no2Nov[$i], $no2Dec[$i]]);
                $i++;
            }
            elseif($q->type == 2)
            {
                $malo2Jan[$j] = AnswersDetails::where('survey_id', '=', $id)->where('answer', '=', '3')->where('question_id', '=', $q->qid)->whereBetween('date', [$year.'-01-01', $year.'-01-31'])->count();
                $malo2Feb[$j] = AnswersDetails::where('survey_id', '=', $id)->where('answer', '=', '3')->where('question_id', '=', $q->qid)->whereBetween('date', [$year.'-02-01', $year.'-02-29'])->count();
                $malo2Mar[$j] = AnswersDetails::where('survey_id', '=', $id)->where('answer', '=', '3')->where('question_id', '=', $q->qid)->whereBetween('date', [$year.'-03-01', $year.'-03-31'])->count();
                $malo2Apr[$j] = AnswersDetails::where('survey_id', '=', $id)->where('answer', '=', '3')->where('question_id', '=', $q->qid)->whereBetween('date', [$year.'-04-01', $year.'-04-30'])->count();
                $malo2May[$j] = AnswersDetails::where('survey_id', '=', $id)->where('answer', '=', '3')->where('question_id', '=', $q->qid)->whereBetween('date', [$year.'-05-01', $year.'-05-31'])->count();
                $malo2Jun[$j] = AnswersDetails::where('survey_id', '=', $id)->where('answer', '=', '3')->where('question_id', '=', $q->qid)->whereBetween('date', [$year.'-06-01', $year.'-06-30'])->count();
                $malo2Jul[$j] = AnswersDetails::where('survey_id', '=', $id)->where('answer', '=', '3')->where('question_id', '=', $q->qid)->whereBetween('date', [$year.'-07-01', $year.'-07-31'])->count();
                $malo2Aug[$j] = AnswersDetails::where('survey_id', '=', $id)->where('answer', '=', '3')->where('question_id', '=', $q->qid)->whereBetween('date', [$year.'-08-01', $year.'-08-31'])->count();
                $malo2Sep[$j] = AnswersDetails::where('survey_id', '=', $id)->where('answer', '=', '3')->where('question_id', '=', $q->qid)->whereBetween('date', [$year.'-09-01', $year.'-09-30'])->count();
                $malo2Oct[$j] = AnswersDetails::where('survey_id', '=', $id)->where('answer', '=', '3')->where('question_id', '=', $q->qid)->whereBetween('date', [$year.'-10-01', $year.'-10-31'])->count();
                $malo2Nov[$j] = AnswersDetails::where('survey_id', '=', $id)->where('answer', '=', '3')->where('question_id', '=', $q->qid)->whereBetween('date', [$year.'-11-01', $year.'-11-30'])->count();
                $malo2Dec[$j] = AnswersDetails::where('survey_id', '=', $id)->where('answer', '=', '3')->where('question_id', '=', $q->qid)->whereBetween('date', [$year.'-12-01', $year.'-12-31'])->count();

                $regular2Jan[$j] = AnswersDetails::where('survey_id', '=', $id)->where('answer', '=', '4')->where('question_id', '=', $q->qid)->whereBetween('date', [$year.'-01-01', $year.'-01-31'])->count();
                $regular2Feb[$j] = AnswersDetails::where('survey_id', '=', $id)->where('answer', '=', '4')->where('question_id', '=', $q->qid)->whereBetween('date', [$year.'-02-01', $year.'-02-29'])->count();
                $regular2Mar[$j] = AnswersDetails::where('survey_id', '=', $id)->where('answer', '=', '4')->where('question_id', '=', $q->qid)->whereBetween('date', [$year.'-03-01', $year.'-03-31'])->count();
                $regular2Apr[$j] = AnswersDetails::where('survey_id', '=', $id)->where('answer', '=', '4')->where('question_id', '=', $q->qid)->whereBetween('date', [$year.'-04-01', $year.'-04-30'])->count();
                $regular2May[$j] = AnswersDetails::where('survey_id', '=', $id)->where('answer', '=', '4')->where('question_id', '=', $q->qid)->whereBetween('date', [$year.'-05-01', $year.'-05-31'])->count();
                $regular2Jun[$j] = AnswersDetails::where('survey_id', '=', $id)->where('answer', '=', '4')->where('question_id', '=', $q->qid)->whereBetween('date', [$year.'-06-01', $year.'-06-30'])->count();
                $regular2Jul[$j] = AnswersDetails::where('survey_id', '=', $id)->where('answer', '=', '4')->where('question_id', '=', $q->qid)->whereBetween('date', [$year.'-07-01', $year.'-07-31'])->count();
                $regular2Aug[$j] = AnswersDetails::where('survey_id', '=', $id)->where('answer', '=', '4')->where('question_id', '=', $q->qid)->whereBetween('date', [$year.'-08-01', $year.'-08-31'])->count();
                $regular2Sep[$j] = AnswersDetails::where('survey_id', '=', $id)->where('answer', '=', '4')->where('question_id', '=', $q->qid)->whereBetween('date', [$year.'-09-01', $year.'-09-30'])->count();
                $regular2Oct[$j] = AnswersDetails::where('survey_id', '=', $id)->where('answer', '=', '4')->where('question_id', '=', $q->qid)->whereBetween('date', [$year.'-10-01', $year.'-10-31'])->count();
                $regular2Nov[$j] = AnswersDetails::where('survey_id', '=', $id)->where('answer', '=', '4')->where('question_id', '=', $q->qid)->whereBetween('date', [$year.'-11-01', $year.'-11-30'])->count();
                $regular2Dec[$j] = AnswersDetails::where('survey_id', '=', $id)->where('answer', '=', '4')->where('question_id', '=', $q->qid)->whereBetween('date', [$year.'-12-01', $year.'-12-31'])->count();

                $bueno2Jan[$j] = AnswersDetails::where('survey_id', '=', $id)->where('answer', '=', '5')->where('question_id', '=', $q->qid)->whereBetween('date', [$year.'-01-01', $year.'-01-31'])->count();
                $bueno2Feb[$j] = AnswersDetails::where('survey_id', '=', $id)->where('answer', '=', '5')->where('question_id', '=', $q->qid)->whereBetween('date', [$year.'-02-01', $year.'-02-29'])->count();
                $bueno2Mar[$j] = AnswersDetails::where('survey_id', '=', $id)->where('answer', '=', '5')->where('question_id', '=', $q->qid)->whereBetween('date', [$year.'-03-01', $year.'-03-31'])->count();
                $bueno2Apr[$j] = AnswersDetails::where('survey_id', '=', $id)->where('answer', '=', '5')->where('question_id', '=', $q->qid)->whereBetween('date', [$year.'-04-01', $year.'-04-30'])->count();
                $bueno2May[$j] = AnswersDetails::where('survey_id', '=', $id)->where('answer', '=', '5')->where('question_id', '=', $q->qid)->whereBetween('date', [$year.'-05-01', $year.'-05-31'])->count();
                $bueno2Jun[$j] = AnswersDetails::where('survey_id', '=', $id)->where('answer', '=', '5')->where('question_id', '=', $q->qid)->whereBetween('date', [$year.'-06-01', $year.'-06-30'])->count();
                $bueno2Jul[$j] = AnswersDetails::where('survey_id', '=', $id)->where('answer', '=', '5')->where('question_id', '=', $q->qid)->whereBetween('date', [$year.'-07-01', $year.'-07-31'])->count();
                $bueno2Aug[$j] = AnswersDetails::where('survey_id', '=', $id)->where('answer', '=', '5')->where('question_id', '=', $q->qid)->whereBetween('date', [$year.'-08-01', $year.'-08-31'])->count();
                $bueno2Sep[$j] = AnswersDetails::where('survey_id', '=', $id)->where('answer', '=', '5')->where('question_id', '=', $q->qid)->whereBetween('date', [$year.'-09-01', $year.'-09-30'])->count();
                $bueno2Oct[$j] = AnswersDetails::where('survey_id', '=', $id)->where('answer', '=', '5')->where('question_id', '=', $q->qid)->whereBetween('date', [$year.'-10-01', $year.'-10-31'])->count();
                $bueno2Nov[$j] = AnswersDetails::where('survey_id', '=', $id)->where('answer', '=', '5')->where('question_id', '=', $q->qid)->whereBetween('date', [$year.'-11-01', $year.'-11-30'])->count();
                $bueno2Dec[$j] = AnswersDetails::where('survey_id', '=', $id)->where('answer', '=', '5')->where('question_id', '=', $q->qid)->whereBetween('date', [$year.'-12-01', $year.'-12-31'])->count();

                $excelente2Jan[$j] = AnswersDetails::where('survey_id', '=', $id)->where('answer', '=', '6')->where('question_id', '=', $q->qid)->whereBetween('date', [$year.'-01-01', $year.'-01-31'])->count();
                $excelente2Feb[$j] = AnswersDetails::where('survey_id', '=', $id)->where('answer', '=', '6')->where('question_id', '=', $q->qid)->whereBetween('date', [$year.'-02-01', $year.'-02-29'])->count();
                $excelente2Mar[$j] = AnswersDetails::where('survey_id', '=', $id)->where('answer', '=', '6')->where('question_id', '=', $q->qid)->whereBetween('date', [$year.'-03-01', $year.'-03-31'])->count();
                $excelente2Apr[$j] = AnswersDetails::where('survey_id', '=', $id)->where('answer', '=', '6')->where('question_id', '=', $q->qid)->whereBetween('date', [$year.'-04-01', $year.'-04-30'])->count();
                $excelente2May[$j] = AnswersDetails::where('survey_id', '=', $id)->where('answer', '=', '6')->where('question_id', '=', $q->qid)->whereBetween('date', [$year.'-05-01', $year.'-05-31'])->count();
                $excelente2Jun[$j] = AnswersDetails::where('survey_id', '=', $id)->where('answer', '=', '6')->where('question_id', '=', $q->qid)->whereBetween('date', [$year.'-06-01', $year.'-06-30'])->count();
                $excelente2Jul[$j] = AnswersDetails::where('survey_id', '=', $id)->where('answer', '=', '6')->where('question_id', '=', $q->qid)->whereBetween('date', [$year.'-07-01', $year.'-07-31'])->count();
                $excelente2Aug[$j] = AnswersDetails::where('survey_id', '=', $id)->where('answer', '=', '6')->where('question_id', '=', $q->qid)->whereBetween('date', [$year.'-08-01', $year.'-08-31'])->count();
                $excelente2Sep[$j] = AnswersDetails::where('survey_id', '=', $id)->where('answer', '=', '6')->where('question_id', '=', $q->qid)->whereBetween('date', [$year.'-09-01', $year.'-09-30'])->count();
                $excelente2Oct[$j] = AnswersDetails::where('survey_id', '=', $id)->where('answer', '=', '6')->where('question_id', '=', $q->qid)->whereBetween('date', [$year.'-10-01', $year.'-10-31'])->count();
                $excelente2Nov[$j] = AnswersDetails::where('survey_id', '=', $id)->where('answer', '=', '6')->where('question_id', '=', $q->qid)->whereBetween('date', [$year.'-11-01', $year.'-11-30'])->count();
                $excelente2Dec[$j] = AnswersDetails::where('survey_id', '=', $id)->where('answer', '=', '6')->where('question_id', '=', $q->qid)->whereBetween('date', [$year.'-12-01', $year.'-12-31'])->count();

                $chart2[] = Charts::multi('line', 'highcharts')
                    ->title($q->name)
                    ->colors(['#bf331a', '#d9e330', '#2bb426', '#7185ea'])
                    ->labels(['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'])
                    ->dataset('Malo', [$malo2Jan[$j], $malo2Feb[$j], $malo2Mar[$j], $malo2Apr[$j], $malo2May[$j], $malo2Jun[$j], $malo2Jul[$j], $malo2Aug[$j], $malo2Sep[$j], $malo2Oct[$j], $malo2Nov[$j], $malo2Dec[$j]])
                    ->dataset('Regular', [$regular2Jan[$j], $regular2Feb[$j], $regular2Mar[$j], $regular2Apr[$j], $regular2May[$j], $regular2Jun[$j], $regular2Jul[$j], $regular2Aug[$j], $regular2Sep[$j], $regular2Oct[$j], $regular2Nov[$j], $regular2Dec[$j]])
                    ->dataset('Bueno', [$bueno2Jan[$j], $bueno2Feb[$j], $bueno2Mar[$j], $bueno2Apr[$j], $bueno2May[$j], $bueno2Jun[$j], $bueno2Jul[$j], $bueno2Aug[$j], $bueno2Sep[$j], $bueno2Oct[$j], $bueno2Nov[$j], $bueno2Dec[$j]])
                    ->dataset('Excelente', [$excelente2Jan[$j], $excelente2Feb[$j], $excelente2Mar[$j], $excelente2Apr[$j], $excelente2May[$j], $excelente2Jun[$j], $excelente2Jul[$j], $excelente2Aug[$j], $excelente2Sep[$j], $excelente2Oct[$j], $excelente2Nov[$j], $excelente2Dec[$j]]);
                $j++;
            }
        }

        return view('data.surveys.trends', ['suranswers' => $suranswers, 'questions' => $questions, 'answersdet' => $answersdet, 'survey' => $survey, 'chart2' => $chart2]);
    }

    public function trendsSatisfaction($id)
    {
        $suranswers = Answers::join('surveys', 'answers.survey_id', '=', 'surveys.id')->select('answers.id AS id', 'answers.name AS name', 'answers.email AS email', 'surveys.id as surid')->where('surveys.id', '=', $id)->paginate(10);
        $questions = Surveys_Questions::join('questions', 'surveys_questions.question_id', '=', 'questions.id')->join('surveys', 'surveys_questions.survey_id', '=', 'surveys.id')->select('questions.question AS name', 'questions.id as qid', 'questions.type as type', 'surveys_questions.position as position')->where('surveys.id', '=', $id)->get();
        $answersdet =  AnswersDetails::join('questions', 'answers_details.question_id', '=', 'questions.id')->select('answers_details.id AS id', 'answers_details.answer AS answer', 'answers_details.survey_id AS survey', 'answers_details.answer_id AS ansid', 'answers_details.comment As comment', 'questions.id as qid')->where('answers_details.survey_id', '=', $id)->get();

        $survey = Surveys::find($id);
        $year = date('Y');

        $i = 0;
        $j = 0;
        foreach($questions as $q)
        {
            if($q->type == 1)
            {
                $satisfecho2Jan[$i] = AnswersDetails::where('survey_id', '=', $id)->where('answer', '=', '1')->where('question_id', '=', $q->qid)->whereBetween('date', [$year.'-01-01', $year.'-01-31'])->count();
                $satisfecho2Feb[$i] = AnswersDetails::where('survey_id', '=', $id)->where('answer', '=', '1')->where('question_id', '=', $q->qid)->whereBetween('date', [$year.'-02-01', $year.'-02-29'])->count();
                $satisfecho2Mar[$i] = AnswersDetails::where('survey_id', '=', $id)->where('answer', '=', '1')->where('question_id', '=', $q->qid)->whereBetween('date', [$year.'-03-01', $year.'-03-31'])->count();
                $satisfecho2Apr[$i] = AnswersDetails::where('survey_id', '=', $id)->where('answer', '=', '1')->where('question_id', '=', $q->qid)->whereBetween('date', [$year.'-04-01', $year.'-04-30'])->count();
                $satisfecho2May[$i] = AnswersDetails::where('survey_id', '=', $id)->where('answer', '=', '1')->where('question_id', '=', $q->qid)->whereBetween('date', [$year.'-05-01', $year.'-05-31'])->count();
                $satisfecho2Jun[$i] = AnswersDetails::where('survey_id', '=', $id)->where('answer', '=', '1')->where('question_id', '=', $q->qid)->whereBetween('date', [$year.'-06-01', $year.'-06-30'])->count();
                $satisfecho2Jul[$i] = AnswersDetails::where('survey_id', '=', $id)->where('answer', '=', '1')->where('question_id', '=', $q->qid)->whereBetween('date', [$year.'-07-01', $year.'-07-31'])->count();
                $satisfecho2Aug[$i] = AnswersDetails::where('survey_id', '=', $id)->where('answer', '=', '1')->where('question_id', '=', $q->qid)->whereBetween('date', [$year.'-08-01', $year.'-08-31'])->count();
                $satisfecho2Sep[$i] = AnswersDetails::where('survey_id', '=', $id)->where('answer', '=', '1')->where('question_id', '=', $q->qid)->whereBetween('date', [$year.'-09-01', $year.'-09-30'])->count();
                $satisfecho2Oct[$i] = AnswersDetails::where('survey_id', '=', $id)->where('answer', '=', '1')->where('question_id', '=', $q->qid)->whereBetween('date', [$year.'-10-01', $year.'-10-31'])->count();
                $satisfecho2Nov[$i] = AnswersDetails::where('survey_id', '=', $id)->where('answer', '=', '1')->where('question_id', '=', $q->qid)->whereBetween('date', [$year.'-11-01', $year.'-11-30'])->count();
                $satisfecho2Dec[$i] = AnswersDetails::where('survey_id', '=', $id)->where('answer', '=', '1')->where('question_id', '=', $q->qid)->whereBetween('date', [$year.'-12-01', $year.'-12-31'])->count();

                $insatisfecho2Jan[$i] = AnswersDetails::where('survey_id', '=', $id)->where('answer', '=', '2')->where('question_id', '=', $q->qid)->whereBetween('date', [$year.'-01-01', $year.'-01-31'])->count();
                $insatisfecho2Feb[$i] = AnswersDetails::where('survey_id', '=', $id)->where('answer', '=', '2')->where('question_id', '=', $q->qid)->whereBetween('date', [$year.'-02-01', $year.'-02-29'])->count();
                $insatisfecho2Mar[$i] = AnswersDetails::where('survey_id', '=', $id)->where('answer', '=', '2')->where('question_id', '=', $q->qid)->whereBetween('date', [$year.'-03-01', $year.'-03-31'])->count();
                $insatisfecho2Apr[$i] = AnswersDetails::where('survey_id', '=', $id)->where('answer', '=', '2')->where('question_id', '=', $q->qid)->whereBetween('date', [$year.'-04-01', $year.'-04-30'])->count();
                $insatisfecho2May[$i] = AnswersDetails::where('survey_id', '=', $id)->where('answer', '=', '2')->where('question_id', '=', $q->qid)->whereBetween('date', [$year.'-05-01', $year.'-05-31'])->count();
                $insatisfecho2Jun[$i] = AnswersDetails::where('survey_id', '=', $id)->where('answer', '=', '2')->where('question_id', '=', $q->qid)->whereBetween('date', [$year.'-06-01', $year.'-06-30'])->count();
                $insatisfecho2Jul[$i] = AnswersDetails::where('survey_id', '=', $id)->where('answer', '=', '2')->where('question_id', '=', $q->qid)->whereBetween('date', [$year.'-07-01', $year.'-07-31'])->count();
                $insatisfecho2Aug[$i] = AnswersDetails::where('survey_id', '=', $id)->where('answer', '=', '2')->where('question_id', '=', $q->qid)->whereBetween('date', [$year.'-08-01', $year.'-08-31'])->count();
                $insatisfecho2Sep[$i] = AnswersDetails::where('survey_id', '=', $id)->where('answer', '=', '2')->where('question_id', '=', $q->qid)->whereBetween('date', [$year.'-09-01', $year.'-09-30'])->count();
                $insatisfecho2Oct[$i] = AnswersDetails::where('survey_id', '=', $id)->where('answer', '=', '2')->where('question_id', '=', $q->qid)->whereBetween('date', [$year.'-10-01', $year.'-10-31'])->count();
                $insatisfecho2Nov[$i] = AnswersDetails::where('survey_id', '=', $id)->where('answer', '=', '2')->where('question_id', '=', $q->qid)->whereBetween('date', [$year.'-11-01', $year.'-11-30'])->count();
                $insatisfecho2Dec[$i] = AnswersDetails::where('survey_id', '=', $id)->where('answer', '=', '2')->where('question_id', '=', $q->qid)->whereBetween('date', [$year.'-12-01', $year.'-12-31'])->count();

                $chart2[] = Charts::multi('line', 'highcharts')
                    ->title($q->name)
                    ->colors(['#1610c5', '#c51010'])
                    ->labels(['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'])
                    ->dataset('Satisfecho', [$satisfecho2Jan[$i], $satisfecho2Feb[$i], $satisfecho2Mar[$i], $satisfecho2Apr[$i], $satisfecho2May[$i], $satisfecho2Jun[$i], $satisfecho2Jul[$i], $satisfecho2Aug[$i], $satisfecho2Sep[$i], $satisfecho2Oct[$i], $satisfecho2Nov[$i], $satisfecho2Dec[$i]])
                    ->dataset('Insatisfecho', [$insatisfecho2Jan[$i], $insatisfecho2Feb[$i], $insatisfecho2Mar[$i], $insatisfecho2Apr[$i], $insatisfecho2May[$i], $insatisfecho2Jun[$i], $insatisfecho2Jul[$i], $insatisfecho2Aug[$i], $insatisfecho2Sep[$i], $insatisfecho2Oct[$i], $insatisfecho2Nov[$i], $insatisfecho2Dec[$i]]);
                $i++;
            }
            elseif($q->type == 2)
            {
                $satisfecho2Jan[$j] = AnswersDetails::where('survey_id', '=', $id)->where('answer', '=', '5')->orWhere('answer', '=', '6')->where('question_id', '=', $q->qid)->whereBetween('date', [$year.'-01-01', $year.'-01-31'])->count();
                $satisfecho2Feb[$j] = AnswersDetails::where('survey_id', '=', $id)->where('answer', '=', '5')->orWhere('answer', '=', '6')->where('question_id', '=', $q->qid)->whereBetween('date', [$year.'-02-01', $year.'-02-29'])->count();
                $satisfecho2Mar[$j] = AnswersDetails::where('survey_id', '=', $id)->where('answer', '=', '5')->orWhere('answer', '=', '6')->where('question_id', '=', $q->qid)->whereBetween('date', [$year.'-03-01', $year.'-03-31'])->count();
                $satisfecho2Apr[$j] = AnswersDetails::where('survey_id', '=', $id)->where('answer', '=', '5')->orWhere('answer', '=', '6')->where('question_id', '=', $q->qid)->whereBetween('date', [$year.'-04-01', $year.'-04-30'])->count();
                $satisfecho2May[$j] = AnswersDetails::where('survey_id', '=', $id)->where('answer', '=', '5')->orWhere('answer', '=', '6')->where('question_id', '=', $q->qid)->whereBetween('date', [$year.'-05-01', $year.'-05-31'])->count();
                $satisfecho2Jun[$j] = AnswersDetails::where('survey_id', '=', $id)->where('answer', '=', '5')->orWhere('answer', '=', '6')->where('question_id', '=', $q->qid)->whereBetween('date', [$year.'-06-01', $year.'-06-30'])->count();
                $satisfecho2Jul[$j] = AnswersDetails::where('survey_id', '=', $id)->where('answer', '=', '5')->orWhere('answer', '=', '6')->where('question_id', '=', $q->qid)->whereBetween('date', [$year.'-07-01', $year.'-07-31'])->count();
                $satisfecho2Aug[$j] = AnswersDetails::where('survey_id', '=', $id)->where('answer', '=', '5')->orWhere('answer', '=', '6')->where('question_id', '=', $q->qid)->whereBetween('date', [$year.'-08-01', $year.'-08-31'])->count();
                $satisfecho2Sep[$j] = AnswersDetails::where('survey_id', '=', $id)->where('answer', '=', '5')->orWhere('answer', '=', '6')->where('question_id', '=', $q->qid)->whereBetween('date', [$year.'-09-01', $year.'-09-30'])->count();
                $satisfecho2Oct[$j] = AnswersDetails::where('survey_id', '=', $id)->where('answer', '=', '5')->orWhere('answer', '=', '6')->where('question_id', '=', $q->qid)->whereBetween('date', [$year.'-10-01', $year.'-10-31'])->count();
                $satisfecho2Nov[$j] = AnswersDetails::where('survey_id', '=', $id)->where('answer', '=', '5')->orWhere('answer', '=', '6')->where('question_id', '=', $q->qid)->whereBetween('date', [$year.'-11-01', $year.'-11-30'])->count();
                $satisfecho2Dec[$j] = AnswersDetails::where('survey_id', '=', $id)->where('answer', '=', '5')->orWhere('answer', '=', '6')->where('question_id', '=', $q->qid)->whereBetween('date', [$year.'-12-01', $year.'-12-31'])->count();

                $insatisfecho2Jan[$j] = AnswersDetails::where('survey_id', '=', $id)->where('answer', '=', '3')->orWhere('answer', '=', '4')->where('question_id', '=', $q->qid)->whereBetween('date', [$year.'-01-01', $year.'-01-31'])->count();
                $insatisfecho2Feb[$j] = AnswersDetails::where('survey_id', '=', $id)->where('answer', '=', '3')->orWhere('answer', '=', '4')->where('question_id', '=', $q->qid)->whereBetween('date', [$year.'-02-01', $year.'-02-29'])->count();
                $insatisfecho2Mar[$j] = AnswersDetails::where('survey_id', '=', $id)->where('answer', '=', '3')->orWhere('answer', '=', '4')->where('question_id', '=', $q->qid)->whereBetween('date', [$year.'-03-01', $year.'-03-31'])->count();
                $insatisfecho2Apr[$j] = AnswersDetails::where('survey_id', '=', $id)->where('answer', '=', '3')->orWhere('answer', '=', '4')->where('question_id', '=', $q->qid)->whereBetween('date', [$year.'-04-01', $year.'-04-30'])->count();
                $insatisfecho2May[$j] = AnswersDetails::where('survey_id', '=', $id)->where('answer', '=', '3')->orWhere('answer', '=', '4')->where('question_id', '=', $q->qid)->whereBetween('date', [$year.'-05-01', $year.'-05-31'])->count();
                $insatisfecho2Jun[$j] = AnswersDetails::where('survey_id', '=', $id)->where('answer', '=', '3')->orWhere('answer', '=', '4')->where('question_id', '=', $q->qid)->whereBetween('date', [$year.'-06-01', $year.'-06-30'])->count();
                $insatisfecho2Jul[$j] = AnswersDetails::where('survey_id', '=', $id)->where('answer', '=', '3')->orWhere('answer', '=', '4')->where('question_id', '=', $q->qid)->whereBetween('date', [$year.'-07-01', $year.'-07-31'])->count();
                $insatisfecho2Aug[$j] = AnswersDetails::where('survey_id', '=', $id)->where('answer', '=', '3')->orWhere('answer', '=', '4')->where('question_id', '=', $q->qid)->whereBetween('date', [$year.'-08-01', $year.'-08-31'])->count();
                $insatisfecho2Sep[$j] = AnswersDetails::where('survey_id', '=', $id)->where('answer', '=', '3')->orWhere('answer', '=', '4')->where('question_id', '=', $q->qid)->whereBetween('date', [$year.'-09-01', $year.'-09-30'])->count();
                $insatisfecho2Oct[$j] = AnswersDetails::where('survey_id', '=', $id)->where('answer', '=', '3')->orWhere('answer', '=', '4')->where('question_id', '=', $q->qid)->whereBetween('date', [$year.'-10-01', $year.'-10-31'])->count();
                $insatisfecho2Nov[$j] = AnswersDetails::where('survey_id', '=', $id)->where('answer', '=', '3')->orWhere('answer', '=', '4')->where('question_id', '=', $q->qid)->whereBetween('date', [$year.'-11-01', $year.'-11-30'])->count();
                $insatisfecho2Dec[$j] = AnswersDetails::where('survey_id', '=', $id)->where('answer', '=', '3')->orWhere('answer', '=', '4')->where('question_id', '=', $q->qid)->whereBetween('date', [$year.'-12-01', $year.'-12-31'])->count();

                $chart2[] = Charts::multi('line', 'highcharts')
                    ->title($q->name)
                    ->colors(['#1610c5', '#c51010'])
                    ->labels(['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'])
                    ->dataset('Satisfecho', [$satisfecho2Jan[$j], $satisfecho2Feb[$j], $satisfecho2Mar[$j], $satisfecho2Apr[$j], $satisfecho2May[$j], $satisfecho2Jun[$j], $satisfecho2Jul[$j], $satisfecho2Aug[$j], $satisfecho2Sep[$j], $satisfecho2Oct[$j], $satisfecho2Nov[$j], $satisfecho2Dec[$j]])
                    ->dataset('Insatisfecho', [$insatisfecho2Jan[$j], $insatisfecho2Feb[$j], $insatisfecho2Mar[$j], $insatisfecho2Apr[$j], $insatisfecho2May[$j], $insatisfecho2Jun[$j], $insatisfecho2Jul[$j], $insatisfecho2Aug[$j], $insatisfecho2Sep[$j], $insatisfecho2Oct[$j], $insatisfecho2Nov[$j], $insatisfecho2Dec[$j]]);
                $j++;
            }
        }

        return view('data.surveys.trends', ['suranswers' => $suranswers, 'questions' => $questions, 'answersdet' => $answersdet, 'survey' => $survey, 'chart2' => $chart2]);
    }

    public function trendsDateQuestions(Request $request, $id)
    {
        $this->validate($request, [
            'dateOne' => 'required|date',
            'dateTwo' => 'required|date'
        ]);

        $suranswers = Answers::join('surveys', 'answers.survey_id', '=', 'surveys.id')->select('answers.id AS id', 'answers.name AS name', 'answers.email AS email', 'surveys.id as surid')->where('surveys.id', '=', $id)->paginate(10);
        $questions = Surveys_Questions::join('questions', 'surveys_questions.question_id', '=', 'questions.id')->join('surveys', 'surveys_questions.survey_id', '=', 'surveys.id')->select('questions.question AS name', 'questions.id as qid', 'questions.type as type', 'surveys_questions.position as position')->where('surveys.id', '=', $id)->get();
        $answersdet =  AnswersDetails::join('questions', 'answers_details.question_id', '=', 'questions.id')->select('answers_details.id AS id', 'answers_details.answer AS answer', 'answers_details.survey_id AS survey', 'answers_details.answer_id AS ansid', 'answers_details.comment As comment', 'questions.id as qid')->where('answers_details.survey_id', '=', $id)->get();

        $dateOne = $request->dateOne;
        $dateTwo = $request->dateTwo;

        $survey = Surveys::find($id);
        $year = date('Y');

        $i = 0;
        $j = 0;
        foreach($questions as $q)
        {
            if($q->type == 1)
            {
                $si2One[$i] = AnswersDetails::where('survey_id', '=', $id)->where('answer', '=', '1')->where('question_id', '=', $q->qid)->where('date', '=', $request->dateOne)->count();
                $si2Two[$i] = AnswersDetails::where('survey_id', '=', $id)->where('answer', '=', '1')->where('question_id', '=', $q->qid)->where('date', '=', $request->dateTwo)->count();

                $no2One[$i] = AnswersDetails::where('survey_id', '=', $id)->where('answer', '=', '2')->where('question_id', '=', $q->qid)->where('date', '=', $request->dateOne)->count();
                $no2Two[$i] = AnswersDetails::where('survey_id', '=', $id)->where('answer', '=', '2')->where('question_id', '=', $q->qid)->where('date', '=', $request->dateTwo)->count();

                $chart2[] = Charts::multi('line', 'highcharts')
                    ->title($q->name)
                    ->colors(['#1610c5', '#c51010'])
                    ->labels([$dateOne, $dateTwo])
                    ->dataset('Si', [$si2One[$i], $si2Two[$i]])
                    ->dataset('No', [$no2One[$i], $no2Two[$i]]);
                $i++;
            }
            elseif($q->type == 2)
            {
                $malo2One[$j] = AnswersDetails::where('survey_id', '=', $id)->where('answer', '=', '3')->where('question_id', '=', $q->qid)->where('date', '=', $request->dateOne)->count();
                $malo2Two[$j] = AnswersDetails::where('survey_id', '=', $id)->where('answer', '=', '3')->where('question_id', '=', $q->qid)->where('date', '=', $request->dateTwo)->count();

                $regular2One[$j] = AnswersDetails::where('survey_id', '=', $id)->where('answer', '=', '4')->where('question_id', '=', $q->qid)->where('date', '=', $request->dateOne)->count();
                $regular2Two[$j] = AnswersDetails::where('survey_id', '=', $id)->where('answer', '=', '4')->where('question_id', '=', $q->qid)->where('date', '=', $request->dateTwo)->count();

                $bueno2One[$j] = AnswersDetails::where('survey_id', '=', $id)->where('answer', '=', '5')->where('question_id', '=', $q->qid)->where('date', '=', $request->dateOne)->count();
                $bueno2Two[$j] = AnswersDetails::where('survey_id', '=', $id)->where('answer', '=', '5')->where('question_id', '=', $q->qid)->where('date', '=', $request->dateTwo)->count();

                $excelente2One[$j] = AnswersDetails::where('survey_id', '=', $id)->where('answer', '=', '6')->where('question_id', '=', $q->qid)->where('date', '=', $request->dateOne)->count();
                $excelente2Two[$j] = AnswersDetails::where('survey_id', '=', $id)->where('answer', '=', '6')->where('question_id', '=', $q->qid)->where('date', '=', $request->dateTwo)->count();

                $chart2[] = Charts::multi('line', 'highcharts')
                    ->title($q->name)
                    ->colors(['#bf331a', '#d9e330', '#2bb426', '#7185ea'])
                    ->labels([$dateOne, $dateTwo])
                    ->dataset('Malo', [$malo2One[$j], $malo2Two[$j]])
                    ->dataset('Regular', [$regular2One[$j], $regular2Two[$j]])
                    ->dataset('Bueno', [$bueno2One[$j], $bueno2Two[$j]])
                    ->dataset('Excelente', [$excelente2One[$j], $excelente2Two[$j]]);
                $j++;
            }
        }
        return view('data.surveys.trends', ['suranswers' => $suranswers, 'questions' => $questions, 'answersdet' => $answersdet, 'survey' => $survey, 'chart2' => $chart2]);
    }

    public function trendsDateSatisfaction(Request $request, $id)
    {
        $this->validate($request, [
            'dateOne' => 'required|date',
            'dateTwo' => 'required|date'
        ]);

        $suranswers = Answers::join('surveys', 'answers.survey_id', '=', 'surveys.id')->select('answers.id AS id', 'answers.name AS name', 'answers.email AS email', 'surveys.id as surid')->where('surveys.id', '=', $id)->paginate(10);
        $questions = Surveys_Questions::join('questions', 'surveys_questions.question_id', '=', 'questions.id')->join('surveys', 'surveys_questions.survey_id', '=', 'surveys.id')->select('questions.question AS name', 'questions.id as qid', 'questions.type as type', 'surveys_questions.position as position')->where('surveys.id', '=', $id)->get();
        $answersdet =  AnswersDetails::join('questions', 'answers_details.question_id', '=', 'questions.id')->select('answers_details.id AS id', 'answers_details.answer AS answer', 'answers_details.survey_id AS survey', 'answers_details.answer_id AS ansid', 'answers_details.comment As comment', 'questions.id as qid')->where('answers_details.survey_id', '=', $id)->get();

        $dateOne = $request->dateOne;
        $dateTwo = $request->dateTwo;

        $survey = Surveys::find($id);
        $year = date('Y');

        $i = 0;
        $j = 0;
        foreach($questions as $q)
        {
            if($q->type == 1)
            {
                $satisfecho2One[$i] = AnswersDetails::where('survey_id', '=', $id)->where('answer', '=', '1')->where('question_id', '=', $q->qid)->where('date', '=', $request->dateOne)->count();
                $satisfecho2Two[$i] = AnswersDetails::where('survey_id', '=', $id)->where('answer', '=', '1')->where('question_id', '=', $q->qid)->where('date', '=', $request->dateTwo)->count();

                $insatisfecho2One[$i] = AnswersDetails::where('survey_id', '=', $id)->where('answer', '=', '2')->where('question_id', '=', $q->qid)->where('date', '=', $request->dateOne)->count();
                $insatisfecho2Two[$i] = AnswersDetails::where('survey_id', '=', $id)->where('answer', '=', '2')->where('question_id', '=', $q->qid)->where('date', '=', $request->dateTwo)->count();

                $chart2[] = Charts::multi('line', 'highcharts')
                    ->title($q->name)
                    ->colors(['#1610c5', '#c51010'])
                    ->labels([$dateOne, $dateTwo])
                    ->dataset('Satisfecho', [$satisfecho2One[$i], $satisfecho2Two[$i]])
                    ->dataset('Insatisfecho', [$insatisfecho2One[$i], $insatisfecho2Two[$i]]);
                $i++;
            }
            elseif($q->type == 2)
            {
                $satisfecho2One[$j] = AnswersDetails::where('survey_id', '=', $id)->whereIn('answer', [5, 6])->where('question_id', '=', $q->qid)->where('date', '=', $request->dateOne)->count();
                $satisfecho2Two[$j] = AnswersDetails::where('survey_id', '=', $id)->whereIn('answer', [5, 6])->where('question_id', '=', $q->qid)->where('date', '=', $request->dateTwo)->count();

                $insatisfecho2One[$j] = AnswersDetails::where('survey_id', '=', $id)->whereIn('answer', [3, 4])->where('question_id', '=', $q->qid)->where('date', '=', $request->dateOne)->count();
                $insatisfecho2Two[$j] = AnswersDetails::where('survey_id', '=', $id)->whereIn('answer', [3, 4])->where('question_id', '=', $q->qid)->where('date', '=', $request->dateTwo)->count();

                $chart2[] = Charts::multi('line', 'highcharts')
                    ->title($q->name)
                    ->colors(['#1610c5', '#c51010'])
                    ->labels([$dateOne, $dateTwo])
                    ->dataset('Satisfecho', [$satisfecho2One[$j], $satisfecho2Two[$j]])
                    ->dataset('Insatisfecho', [$insatisfecho2One[$j], $insatisfecho2Two[$j]]);
                $j++;
            }
        }

        return view('data.surveys.trends', ['suranswers' => $suranswers, 'questions' => $questions, 'answersdet' => $answersdet, 'survey' => $survey, 'chart2' => $chart2]);
    }

    public function fliers($id)
    {
        $surveys = Surveys::find($id);
        Session::put('surid', $surveys->id);
        return view('data.surveys.fliers', ['surveys' => $surveys]);
    }

    public function flierpdf($id)
    {
        $id = Session::get('surid');
        $surveys = Surveys::find($id);
        $date = date('Y-m-d');
        $invoice = "Flier de ".$surveys->name;
        $view =  \View::make('data.surveys.flierpdf', compact('surveys', 'date', 'invoice'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        $pdf->setPaper('A3','landscape');
        return $pdf->setWarnings(false)->stream('flier.pdf');
    }

    public function flierminipdf($id)
    {
        $id = Session::get('surid');
        $surveys = Surveys::find($id);
        $date = date('Y-m-d');
        $invoice = "Flier de ".$surveys->name;
        $view =  \View::make('data.surveys.flierminipdf', compact('surveys', 'date', 'invoice'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        $pdf->setPaper('A3','landscape');
        return $pdf->setWarnings(false)->stream('flier.pdf');
    }

    public function shared($id)
    {
        $answers = Answers::find($id);
        $answersdetails = AnswersDetails::where('answer_id', '=', $id)->get();
        $questions = Questions::join('Surveys_Questions', 'questions.id', '=', 'surveys_questions.question_id')->select('questions.question as name', 'questions.id as id', 'surveys_questions.position as position')->where('surveys_questions.survey_id', '=', $answers->survey_id)->get();
        
        return view('pages.shared', ['answers' => $answers, 'answersdetails' => $answersdetails, 'questions' => $questions]);
    }

}
