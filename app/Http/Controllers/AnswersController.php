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
use App\Emails;
use App\User_Email;
use App\Waiters;
use App\User_Waiter;

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
        if($request->table != null)
        {
            $answer->table = $request->table;
        }
        $answer->date = date('Y-m-d');
        $answer->calification = 1;
        $answer->survey_id = $request->survey_id;
        if($surveys->flag == 1)
        {
            $answer->waiter_id = $request->radio;
        }
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
        $subCal = $i/$max;
        $cal = $subCal*100;
        $answer2->calification = $cal;
        $answer2->save();
        
        $survey = Surveys::find($answer2->survey_id);
        $user = User::find($survey->user_id);

        $suranswers = Answers::join('surveys', 'answers.survey_id', '=', 'surveys.id')->select('answers.id AS id', 'answers.name AS name', 'answers.email AS email', 'answers.table AS table', 'surveys.id as surid', 'answers.calification AS calification')->where('answers.id', '=', $answer2->id)->first();
        $questions = Surveys_Questions::join('questions', 'surveys_questions.question_id', '=', 'questions.id')->join('surveys', 'surveys_questions.survey_id', '=', 'surveys.id')->select('questions.question AS name')->where('surveys.id', '=', $survey->id)->get();
        $answersdet =  AnswersDetails::join('questions', 'answers_details.question_id', '=', 'questions.id')->select('answers_details.id AS id', 'answers_details.answer AS answer', 'answers_details.survey_id AS survey', 'answers_details.answer_id AS ansid', 'answers_details.comment As comment', 'questions.id AS question_id')->where('answers_details.answer_id', '=', $answer2->id)->get();

        $emails = Emails::join('user_email', 'emails.id', '=', 'user_email.email_id')->join('users', 'user_email.user_id', '=', 'users.id')->select('emails.id as id', 'emails.email as email', 'users.email as uemail')->where('user_id', '=', $surveys->user_id)->get();

        $ea = 0;
        foreach($emails as $e)
        {
            $em[$ea] = $e->email;
            $ea++;
        }
        
        if($answer2->calification > 65 && $answer2->calification <= 75)
        {
            $c = 'Regular';
            $title = 'Resultado de Encuesta #'.$survey->id;
            $content = 'Has recibido una calificacion '.$c.', puedes verificar iniciando sesion en la plataforma de calificame';
            Mail::send('data.emailsf.badanswers', ['title' => $title, 'content' => $content, 'suranswers' => $suranswers, 'questions' => $questions, 'answersdet' => $answersdet, 'survey' => $survey, 'user' => $user, 'c' => $c], function ($message) use ($c, $user, $em)
            {

                $message->from('contacto@calificame.mx', 'Calificame')->subject('Has recibido una calificacion '.$c);

                $message->to($em);

            });
        }
        elseif($answer2->calification >= 0 && $answer2->calification <= 64)
        {
            $c = 'Mala';
            $title = 'Resultado de Encuesta #'.$survey->id;
            $content = 'Has recibido una calificacion '.$c.', puedes verificar iniciando sesion en la plataforma de calificame';
            Mail::send('data.emailsf.badanswers', ['title' => $title, 'content' => $content, 'suranswers' => $suranswers, 'questions' => $questions, 'answersdet' => $answersdet, 'survey' => $survey, 'user' => $user, 'c' => $c], function ($message) use ($c, $user, $em)
            {

                $message->from('contacto@calificame.mx', 'Calificame')->subject('Has recibido una calificacion '.$c);

                $message->to($em);

            });
        }
        Session::put('surveyid', $request->survey_id);

        if($surveys->flag == 0)
        {
            return view('pages.surveyFinish');
        }
        elseif($surveys->flag == 1)
        {
            $waiters = Waiters::join('user_waiters', 'waiters.id', '=', 'user_waiters.waiter_id')->join('users', 'user_waiters.user_id', '=', 'users.id')->select('waiters.id as id', 'waiters.name as name', 'waiters.url as url')->where('waiters.status', '=', '1')->where('user_id', '=', Auth::id())->get();
            $wait = Waiters::join('user_waiters', 'waiters.id', '=', 'user_waiters.waiter_id')->join('users', 'user_waiters.user_id', '=', 'users.id')->select('waiters.id as id', 'waiters.name as name', 'waiters.url as url')->where('waiters.status', '=', '1')->where('user_id', '=', Auth::id())->count();
            return redirect('s2/'.$answer2->id)->with(['answer2' => $answer2, 'waiters' => $waiters, 'wait' => $wait]);
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
        if($request->button1) {
            return view('pages.surveyFinish');
        }
        elseif($request->button2)
        {
                $this->validate($request, [
                    'radio' => 'required',
                ]);

                $answer = Answers::find($id);
                $answer->waiter_id = $request->radio;
                $answer->save();
                return view('pages.surveyFinish');
        }
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
