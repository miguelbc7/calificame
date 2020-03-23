<?php

/*
 * Taken from
 * https://github.com/laravel/framework/blob/5.3/src/Illuminate/Auth/Console/stubs/make/controllers/HomeController.stub
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Session;
use App;
use Mail;
use Redirect;
use App\User;
use App\Payment;
use App\SocialNetworks;
use App\User_Payment;
use App\Emails;
use App\User_Email;

/**
 * Class HomeController
 * @package App\Http\Controllers
 */
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    public function index()
    {
        $socialnetworks = SocialNetworks::find(1);
        $day = date('d');
        $m = date('m');
        $year = date('Y');

        if($m == 1)
        {
            $month = 'Enero'; 
        }
        elseif($m == 2)
        {
            $month = 'Febrero';
        }
        elseif($m == 3)
        {
            $month = 'Marzo';
        }
        elseif($m == 4)
        {
            $month = 'Abril';
        }
        elseif($m == 5)
        {
            $month = 'Mayo';
        }
        elseif($m == 6)
        {
            $month = 'Junio';
        }
        elseif($m == 7)
        {
            $month = 'Julio';
        }
        elseif($m == 8)
        {
            $month = 'Agosto';
        }
        elseif($m == 9)
        {
            $month = 'Septiembre';
        }
        elseif($m == 10)
        {
            $month = 'Octubre';
        }
        elseif($m == 11)
        {
            $month = 'Noviembre';
        }
        elseif($m == 12)
        {
            $month = 'Diciembre';
        }

        return view('pages.index', ['day' => $day, 'month' => $month, 'year' => $year, 'socialnetworks' => $socialnetworks]);
    }

    public function terms()
    {
        return view('pages.terms');
    }

    public function privacy()
    {
        return view('pages.privacy');
    }

    public function contract()
    {
        return view('pages.contract');
    }

    public function regis()
    {
        return view('adminlte::auth/register');
    }

    public function userstore(Request $request)
    {
        $this->validate($request, [
            'company' => 'required|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required',
            'terms' => 'accepted',
        ]);

        $user = new User;
        $user->company = $request->company;
        $user->email = $request->email;
        if(isset($request->cellphone))
        {
            $user->cellphone = $request->cellphone;
        }
        $user->type = 1;
        $user->branch = 1;
        $user->status = 1;
        $user->password = $request->password;
        $user->save();
        auth()->login($user);

        $user = User::find(Auth::id());

        $destinationPath = 'img/users/'.Auth::id().'/avatar/'; // upload path
        $destinationPath2 = base_path() . '/public/img/users/'.Auth::id().'/avatar/'; // upload path
        $extension = 'jpg'; // getting image extension
        $fileName = 'avatar.'.$extension; // renameing image
        $request->file('avatar')->move($destinationPath2, $fileName); // uploading file to given path
        $user->avatar = $destinationPath.'/'.$fileName;
        $user->save();
        $payment = New Payment;
        $payment->dateIn = date('Y-m-d');
        $dateIn = date('Y-m-d');
        $dateOut = strtotime('+1 month', strtotime($dateIn));
        $dateOut2 = date('Y-m-d', $dateOut);
        $payment->dateOut = $dateOut2;
        $payment->amount = 0;
        $payment->type = 1;
        $payment->save();
        $userpay = New User_Payment;
        $userpay->user_id = $user->id;
        $userpay->payment_id = $payment->id;
        $userpay->save();

        $email = New Emails;
        $email = $request->email;
        $email->save();

        $eu = New User_Email;
        $eu->user_id = $user->id;
        $eu->email_id = $email->id;
        $eu->save();

        $user = User::find(Auth::id());

        $title = 'Registro en Calificame Completado';
        $content = 'Bienvenido, '.$user->name.' Has completado tu registro en calificame';

        $emails = Emails::join('user_email', 'emails.id', '=', 'user_email.email_id')->join('users', 'user_email.user_id', '=', 'users.id')->select('emails.id as id', 'emails.email as email', 'users.email as uemail')->where('user_id', '=', Auth::id())->get();

        $em = $user->email;
        
        Mail::send('data.emailsf.newuser', ['title' => $title, 'content' => $content], function ($message) use ($em)
        {

            $message->from('contacto@calificame.mx', 'Calificame')->subject('Bienvenido a Calificame');

            $message->to($em);

        });


        return view('adminlte::home');
    }

    public function login()
    {
        return view('adminlte::auth/login');
    }

    public function admin()
    {
        $user = User::find(Auth::id());
        $userpay = User_Payment::select('payment_id')->where('user_id', '=', Auth::id())->first();
        $do = Payment::where('id', '=', $userpay->payment_id)->orderBy('dateOut', 'desc')->first();

        if(isset($do))
        {
            if($do->dateOut <= date('Y-m-d'))
            {
                $user->status = 2;
                $user->save();
            }
        }
        $user = User::find(Auth::id());

        Session::put('status', $user->status);
        Session::put('utype', $user->type);

        return view('adminlte::home');
    }

    public function survey()
    {
        return view('pages.survey2');
    }

    public function saveuser(Request $request)
    {
        $this->validate($request, [
            'company' => 'required|max:255|unique:users',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required|min:6',
            'terms' => 'required',
        ]);

        $user = New User;
        $user->company = $request->company;
        $user->email = $request->email;
        if(isset($request->cellphone))
        {
            $user->cellphone = $request->cellphone;
        }
        $user->password = $request->password;
        $user->type = 2;
        $user->status = 1;
        $user->branch = 1;
        $user->save();

        if(isset($request->avatar))
        {
            $us = User::find($user->id);
            $destinationPath = 'img/users/'.$user->id.'/avatar'; // upload path
            $destinationPath2 = base_path() . '/public_html/img/users/'.$user->id.'/avatar'; // upload path
            $extension = 'jpg'; // getting image extension
            $fileName = 'avatar.'.$extension; // renameing image
            $request->file('avatar')->move($destinationPath2, $fileName); // uploading file to given path
            $us->avatar = $destinationPath.'/'.$fileName;
            $us->save();
        }

        $payment = New Payment;
        $payment->dateIn = date('Y-m-d');
        $dateIn = date('Y-m-d');
        $dateOut = strtotime('+1 month', strtotime($dateIn));
        $dateOut2 = date('Y-m-d', $dateOut);
        $payment->dateOut = $dateOut2;
        $payment->amount = 0;
        $payment->type = 1;
        $payment->save();
        $userpay = New User_Payment;
        $userpay->user_id = $user->id;
        $userpay->payment_id = $payment->id;
        $userpay->save();

        $email = New Emails;
        $email = $request->email;
        $email->save();

        $eu = New User_Email;
        $eu->user_id = $user->id;
        $eu->email_id = $email->id;
        $eu->save();

        $title = 'Bienvenido a Calificame';
        $content = 'Nos complace en darte la bienvenida a Calificame '.$request->name.', esperamos disfrutes de tu mes gratuito';

        $em = $user->email;

        Mail::send('data.emailsf.newuser', ['title' => $title, 'content' => $content], function ($message) use ($em)
        {

            $message->from('contacto@calificame.mx', 'Calificame')->subject('Bienvenido a Calificame');

            $message->to($em);

        });

        return redirect('/home');
    }

    public function support()
    {
        return view('data.user.support');
    }
}