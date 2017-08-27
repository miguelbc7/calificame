<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use Redirect;
use Mail;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;
use App\Surveys;
use App\Questions;
use App\Surveys_Questions;
use App\Answers;
use App\AnswersDetails;
use App\User;

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
        //$questions = Questions::where('survey_id', '=', $request->survey_id)->count();
        //$max = $questions * 25;

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
        $answer->calification = 1;
        $answer->survey_id = $request->survey_id;
        $answer->save();

        $ansid = $answer->id;

        $i = 0;
        $j = 0;
        $cal = 0;

        foreach($surquestions as $sq)
        {
            $this->validate($request, [
                'option'.$sq->position => 'required',
                'question_id'.$sq->position => 'required',
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
            $answerdetail->question_id = $request->input('question_id'.$sq->position);

            if($request->input('option'.$sq->position) == 1)
            {
               $cal = 25;
            }
            elseif($request->input('option'.$sq->position) == 2)
            {
                $cal = 0;
            }
            elseif($request->input('option'.$sq->position) == 3)
            {
                $cal = 0;
            }
            elseif($request->input('option'.$sq->position) == 4)
            {
                $cal = 15;
            }
            elseif($request->input('option'.$sq->position) == 5)
            {
                $cal = 20;
            }
            elseif($request->input('option'.$sq->position) == 6)
            {
                $cal = 25;
            }

            $i = $i + $cal;
            $j++;

            $answerdetail->save();
        }
        $answer2 = Answers::find($ansid);
        $max = $j * 25;
        $subCal = $i/$j;
        $cal = $subCal*100;
        $answer2->calification = $cal;
        $answer2->save();
        
        $survey = Surveys::find($answer2->survey_id);
        $user = User::find($survey->user_id);

        $suranswers = Answers::join('surveys', 'answers.survey_id', '=', 'surveys.id')->select('answers.id AS id', 'answers.name AS name', 'answers.email AS email', 'surveys.id as surid', 'answers.calification AS calification')->where('answers.id', '=', $answer2->id)->first();
        $questions = Surveys_Questions::join('questions', 'surveys_questions.question_id', '=', 'questions.id')->join('surveys', 'surveys_questions.survey_id', '=', 'surveys.id')->select('questions.question AS name')->where('surveys.id', '=', $survey->id)->get();
        $answersdet =  AnswersDetails::join('questions', 'answers_details.question_id', '=', 'questions.id')->select('answers_details.id AS id', 'answers_details.answer AS answer', 'answers_details.survey_id AS survey', 'answers_details.answer_id AS ansid', 'answers_details.comment As comment', 'questions.id AS question_id')->where('answers_details.answer_id', '=', $answer2->id)->get();


        if($answer2->calification > 65 && $answer2->calification <= 75)
        {
            $c = 'Regular';
             $title = 'Resultado de Encuesta #'.$survey->id;
            $content = 'Has recibido una calificacion '.$c.', puedes verificar iniciando sesion en la plataforma de calificame';
            Mail::send('data.emails.badanswers', ['title' => $title, 'content' => $content, 'suranswers' => $suranswers, 'questions' => $questions, 'answersdet' => $answersdet, 'survey' => $survey, 'user' => $user], function ($message) use ($c, $user)
            {

                $message->from('miguel.lm21@gmail.com', 'Calificame')->subject('Has recibido una calificacion '.$c);

                $message->to($user->email);

            });
        }
        elseif($answer2->calification >= 0 && $answer2->calification <= 64)
        {
            $c = 'Mala';
            $title = 'Resultado de Encuesta #'.$survey->id;
            $content = 'Has recibido una calificacion '.$c.', puedes verificar iniciando sesion en la plataforma de calificame';
            Mail::send('data.emails.badanswers', ['title' => $title, 'content' => $content, 'suranswers' => $suranswers, 'questions' => $questions, 'answersdet' => $answersdet, 'survey' => $survey, 'user' => $user], function ($message) use ($c, $user)
            {

                $message->from('miguel.lm21@gmail.com', 'Calificame')->subject('Has recibido una calificacion '.$c);

                $message->to($user->email);

            });
        }
        Session::put('surveyid', $request->survey_id);
        return view('pages.surveyFinish');
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
