<?php

/*
 * Taken from
 * https://github.com/laravel/framework/blob/5.3/src/Illuminate/Auth/Console/stubs/make/controllers/HomeController.stub
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App;
use Redirect;
use App\User;

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
        return view('pages.index');
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
        return view('adminlte::home');
    }

    public function login()
    {
        return view('adminlte::auth/login');
    }

    public function admin()
    {
        return view('adminlte::home');
    }
}