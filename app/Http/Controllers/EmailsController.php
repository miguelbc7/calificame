<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use Redirect;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;
use App\Users;
use App\Emails;
use App\User_Email;

class EmailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $emails = Emails::join('user_email', 'emails.id', '=', 'user_email.email_id')->join('users', 'user_email.user_id', '=', 'users.id')->select('emails.id as id', 'emails.email as email', 'users.email as uemail')->where('user_id', '=', Auth::id())->paginate(10);

        return view('data.emails.index', ['emails'=>$emails]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('data.emails.create');
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
            'email' => 'required|email',
        ]);

        $emails = new Emails;
        $emails->fill($request->all());
        $emails->save();
        $useremail = new User_Email;
        $useremail->email_id = $emails->id;
        $useremail->user_id = Auth::id();
        $useremail->save();
        return redirect('/emails')->with('message','Correo Registrado Correctamente');
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
        $emails = Emails::find($id);
        return view('data.emails.edit', ['emails'=>$emails]);
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
            'email' => 'required|email',
        ]);

        $emails = Emails::find($id);
        $emails->fill($request->all());
        $emails->save();
        return redirect('/emails')->with('message','Correo Actualizado Correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $useremail = User_Email::where('email_id', '=', $id)->delete();
        $emails = Emails::find($id);
        $emails->delete();
        return redirect('/emails')->with('message','Correo Eliminado Correctamente');
    }
}
