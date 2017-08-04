<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use Redirect;
use Hash;
use Mail;
use Paypal;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Payment;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::join('payments', 'users.id', '=', 'payments.user_id')->select('users.id As id', 'users.company As company', 'users.email As email', 'users.status As status', 'payments.dateIn as datein', 'payments.dateOut as dateout')->where('users.type', '=', 2)->paginate(10);
        return view('data.users.index', ['users'=>$users]);
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
        //
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

    public function validateu($id)
    {
        $user = User::find($id);
        $types = collect([['id'=>'1', 'name'=>'1 mes'], ['id'=>'2', 'name'=>'3 meses'], ['id'=>'3', 'name'=>'6 meses'], ['id'=>'4', 'name'=>'12 meses']]);
        $types = $types->pluck('name', 'id')->all();
        return view('data.users.validate', ['user'=>$user, 'types'=>$types]);
    }

    public function active(Request $request, $id)
    {
        $user = User::find($id);
        $payment = Payment::where('user_id', '=', $id)->first();
        $payment->dateIn = $request->dateIn;
        $payment->type = $request->type;
        
        if($request->type == 1)
        {
            $dateIn = $request->dateIn;
            $dateOut = strtotime ( '+1 month' , strtotime ( $dateIn ) ) ;
            $dateOut = date ( 'Y-m-j' , $dateOut );
            $amount = 400.00 * $user->branch;
        }
        elseif($request->type == 2)
        {
            $dateIn = $request->dateIn;
            $dateOut = strtotime ( '+3 month' , strtotime ( $dateIn ) ) ;
            $dateOut = date ( 'Y-m-j' , $dateOut );
            $amount = 1100.00 * $user->branch;
        }
        elseif($request->type == 3)
        {
            $dateIn = $request->dateIn;
            $dateOut = strtotime ( '+6 month' , strtotime ( $dateIn ) ) ;
            $dateOut = date ( 'Y-m-j' , $dateOut );
            $amount = 2000.00 * $user->branch;
        }
        elseif($request->type == 4)
        {
            $dateIn = $request->dateIn;
            $dateOut = strtotime ( '+12 month' , strtotime ( $dateIn ) ) ;
            $dateOut = date ( 'Y-m-j' , $dateOut );
            $amount = 4000.00 * $user->branch;
        }
        $payment->dateOut = $dateOut;
        $payment->amount = $amount;
        $payment->user_id = $id;
        $payment->save();
        $user->status = 1;
        $user->save();
        return redirect('/users')->with('message','Usuario Activado Correctamente');
    }

    public function renew()
    {
        return view('data.user.renew');
    }

    public function renewpaypal(Request $request)
    {
        $this->validate($request, [
            'type' => 'required|max:255',
            'branch' => 'required',
        ]);

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

        Session::put('type', $request->type);
        Session::put('amount', $total);
        Session::put('brnach', $request->branch);

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
        $redirectUrls->setReturnUrl(route('getDoneR'));
        $redirectUrls->setCancelUrl(route('getCancelR'));

        $payment = PayPal::Payment();
        $payment->setIntent('sale');
        $payment->setPayer($payer);
        $payment->setRedirectUrls($redirectUrls);
        $payment->setTransactions(array($transaction));

        $response = $payment->create($this->_apiContext);
        $redirectUrl = $response->links[1]->href;

        return redirect()->to( $redirectUrl );

    }

    public function renewmoney(Request $request)
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

        Mail::send('data.renews.email', ['title' => $title, 'content' => $content, 'price1' => $price1, 'price2' => $price2, 'price3' => $price3, 'price4' => $price4, 'bank' => $bank, 'account' => $account, 'name' => $name, 'cable' => $cable], function ($message)
        {

            $message->from('miguel.lm21@gmail.com', 'Calificame')->subject('Datos para transferencias o depositos en Calificame');

            $message->to(Auth::user()->email);

        });

        return redirect('/admin')->with('message','Se ha enviado un correo a: '.Auth::user()->email);
    }

    public function getDoneR(Request $request)
    {
        $id = $request->get('paymentId');
        $token = $request->get('token');
        $payer_id = $request->get('PayerID');
        
        $payment = PayPal::getById($id, $this->_apiContext);

        $paymentExecution = PayPal::PaymentExecution();

        $paymentExecution->setPayerId($payer_id);
        $executePayment = $payment->execute($paymentExecution, $this->_apiContext);

        $user = User::find(Auth::id());
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
        $user->status = 1;
        $user->branch = Session::get('branch');
        $user->save();

        // Clear the shopping cart, write to database, send notifications, etc.

        // Thank the user for the purchase
        return redirect()->route('index');
    }

    public function getCancelR()
    {
        return redirect()->route('renew');
    }

}