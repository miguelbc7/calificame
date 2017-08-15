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
        $user->fill($request->all());
        $user->password = bcrypt($request->password);
        $user->save();
        auth()->login($user);

        $user = User::find(Auth::id());
        
        if(isset($request->avatar))
        {
            $destinationPath = 'img/Users/'.Auth::id().'/avatar/'; // upload path
            $destinationPath2 = base_path() . '/public/img/Users/'.Auth::id().'/avatar/'; // upload path
            $extension = 'jpg'; // getting image extension
            $fileName = 'avatar.'.$extension; // renameing image
            $request->file('avatar')->move($destinationPath2, $fileName); // uploading file to given path
            $user->image = $destinationPath.'/'.$fileName;
            $user->save();      
        }
        else
        {
            $destinationPath = 'img/Users/0/avatar/'; // upload path
            $destinationPath2 = base_path() . '/public/img/Users/0/avatar/'; // upload path
            $extension = 'jpg'; // getting image extension
            $user->image = $destinationPath.'/avatar.png';
            $user->save();
        }

        $user = User::find(Auth::id());

        $title = 'Registro en Calificame Completado';
        $content = 'Bienvenido, '.$user->name.' Has completado tu registro en calificame';
        Mail::send('data.emails.badanswers', ['title' => $title, 'content' => $content], function ($message) use ($user)
        {

            $message->from('miguel.lm21@gmail.com', 'Calificame')->subject('Registro en Calificame Completado');

            $message->to($user->email);

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
        $do = Payment::where('user_id', '=', Auth::id())->orderBy('dateOut', 'desc')->first();

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
            'type' => 'required',
            'pay' => 'required',
            'branch' => 'required',
            'company' => 'required|max:255|unique:users',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
            'terms'    => 'required',
        ]);

        if($request->pay == 1)
        {
            if($request->type == 1)
            {
                $total = 400 * $request->branch;
            }
            elseif($request->type == 2)
            {
                $total = 1100 * $request->branch;
            }
            elseif($request->type == 3)
            {
                $total = 2000 * $request->branch;
            }
            elseif($request->type == 4)
            {
                $total = 4000 * $request->branch;
            }

            Session::put('company', $request->company);
            Session::put('email', $request->email);
            Session::put('password', $request->password);
            Session::put('type', $request->type);
            Session::put('amount', $total);
            Session::put('branch', $request->branch);

            if(isset($request->avatar))
            {
                Session::put('avatar', $request->avatar);
            }
            

            session_start();
            $payer = PayPal::Payer();
            $payer->setPaymentMethod('paypal');
            $amount = PayPal:: Amount();
            $amount->setCurrency('MXN');
            $amount->setTotal($total);

            $transaction = PayPal::Transaction();
            $transaction->setAmount($amount);
            $transaction->setDescription('Buy in Calificame for $'.$total);

            $redirectUrls = PayPal:: RedirectUrls();
            $redirectUrls->setReturnUrl(route('getDone'));
            $redirectUrls->setCancelUrl(route('getCancel'));

            $payment = PayPal::Payment();
            $payment->setIntent('sale');
            $payment->setPayer($payer);
            $payment->setRedirectUrls($redirectUrls);
            $payment->setTransactions(array($transaction));

            $response = $payment->create($this->_apiContext);
            $redirectUrl = $response->links[1]->href;

            return redirect()->to( $redirectUrl );
        }
        elseif($request->pay == 2)
        {
            $title = 'Datos para transferencias o depositos';
            $content = 'Debes enviar un correo electronico a esta direccion '.Auth::user()->email.' con el comprobante de pago y detallando cuantas sucursales registraras';
            $bank = 'Banco: Banorte';
            $account = 'Numero de Cuenta: 0570103211';
            $name = 'Nombre: Meliton Alcaraz Manjarrez';
            $cable = 'Cable Interbancaria: 072 730 00570103211 7';
            $price1 = '1 Mes: $400 por sucursal';
            $price2 = '3 Mes: $1100 por sucursal';
            $price3 = '6 Mes: $2000 por sucursal';
            $price4 = '12 Mes: $4000 por sucursal';

            Mail::send('data.emails.renew', ['title' => $title, 'content' => $content, 'price1' => $price1, 'price2' => $price2, 'price3' => $price3, 'price4' => $price4, 'bank' => $bank, 'account' => $account, 'name' => $name, 'cable' => $cable], function ($message)
            {

                $message->from('miguel.lm21@gmail.com', 'Calificame')->subject('Datos para transferencias o depositos en Calificame');

                $message->to($request->email);

            });

            $user = New User;
            $user->company = $request->company;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $users->type = 2;
            $users->status = 2;
            $users->branch = $request->branch;

            if(isset($request->avatar))
            {
                $destinationPath = 'img/Users/'.Auth::id().'/avatar/'; // upload path
                $destinationPath2 = base_path() . '/public/img/Users/'.Auth::id().'/avatar/'; // upload path
                $extension = 'jpg'; // getting image extension
                $fileName = 'avatar.'.$extension; // renameing image
                $request->file('avatar')->move($destinationPath2, $fileName); // uploading file to given path
                $user->image = $destinationPath.'/'.$fileName;
                $user->save();      
            }
            else
            {
                $destinationPath = 'img/Users/0/avatar/'; // upload path
                $destinationPath2 = base_path() . '/public/img/Users/0/avatar/'; // upload path
                $extension = 'jpg'; // getting image extension
                $user->image = $destinationPath.'/avatar.png';
                $user->save();
            }

            return redirect('/home');
        }
    }

    public function getDone(Request $request)
    {
        $id = $request->get('paymentId');
        $token = $request->get('token');
        $payer_id = $request->get('PayerID');
        
        $payment = PayPal::getById($id, $this->_apiContext);

        $paymentExecution = PayPal::PaymentExecution();

        $paymentExecution->setPayerId($payer_id);
        $executePayment = $payment->execute($paymentExecution, $this->_apiContext);

        $user = New User;
        $user->company = Session::get('company');
        $user->email = Session::get('email');
        $user->password = bcrypt(Session::get('password'));
        $user->type = 2;
        $user->status = 1;
        $user->branch = Session::get('branch');
        $user->save();
        
        auth()->login($user);

        $user = User::find(Auth::id());
        if(!null(Session::get('avatar')))
        {
            $destinationPath = 'img/Users/'.Auth::id().'/avatar/'; // upload path
            $destinationPath2 = base_path() . '/public/img/Users/'.Auth::id().'/avatar/'; // upload path
            $extension = 'jpg'; // getting image extension
            $fileName = 'avatar.'.$extension; // renameing image
            $request->file('avatar')->move($destinationPath2, $fileName); // uploading file to given path
            $user->image = $destinationPath.'/'.$fileName;
            $user->save();      
        }
        else
        {
            $destinationPath = 'img/Users/0/avatar/'; // upload path
            $destinationPath2 = base_path() . '/public/img/Users/0/avatar/'; // upload path
            $extension = 'jpg'; // getting image extension
            $user->image = $destinationPath.'/avatar.png';
            $user->save();
        }
        $user->save();

        $payment = Payment::where('user_id', '=', Auth::id())->first();
        $dateIn = date('Y-m-d');
        $payment->dateIn = $dateIn;
        $dateOut = strtotime ( '+12 month' , strtotime ( $dateIn ) ) ;
        $dateOut = date ( 'Y-m-j' , $dateOut );
        $payment->dateOut = $dateOut;
        $payment->amount = Session::get('amount');
        $payment->type = Session::get('type');
        $payment->user_id = Auth::id();
        $payment->save();
        

        // Clear the shopping cart, write to database, send notifications, etc.

        // Thank the user for the purchase
        return redirect()->route('admin');
    }

    public function getCancel()
    {
        return redirect()->route('home');
    }
}