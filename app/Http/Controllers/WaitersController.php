<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use Redirect;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;
use App\Users;
use App\Waiters;
use App\User_Waiter;

class WaitersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $waiters = Waiters::join('user_waiters', 'waiters.id', '=', 'user_waiters.waiter_id')->join('users', 'user_waiters.user_id', '=', 'users.id')->select('waiters.id as id', 'waiters.name as name', 'waiters.url as url')->where('waiters.status', '=', 1)->where('user_id', '=', Auth::id())->paginate(10);

        return view('data.waiters.index', ['waiters'=>$waiters]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('data.waiters.create');
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
            'name' => 'required',
            'url' => 'required',
        ]);

        $waiters = new Waiters;
        $waiters->fill($request->all());
        $waiters->url = 0;
        $waiters->status = 1;
        $waiters->save();

        $waiters = Waiters::find($waiters->id);
        $destinationPath = 'images/waiters/'.$waiters->id; // upload path
        $destinationPath2 = base_path() . '/public_html/images/waiters/'.$waiters->id; // upload path
        $extension = 'jpg'; // getting image extension
        $fileName = $waiters->id.'.'.$extension; // renameing image
        $request->file('url')->move($destinationPath2, $fileName); // uploading file to given path   
        $waiters->url = $destinationPath.'/'.$fileName;
        $waiters->save();

        $userwaiter = new User_Waiter;
        $userwaiter->waiter_id = $waiters->id;
        $userwaiter->user_id = Auth::id();
        $userwaiter->save();
        return redirect('/waiters')->with('message','Mesero Registrado Correctamente');
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
        $waiters = Waiters::find($id);
        return view('data.waiters.edit', ['waiters'=>$waiters]);
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
            'name' => 'required',
        ]);

        $waiters = Waiters::find($id);
        $waiters->fill($request->all());

        if(isset($request->url))
        {
            $destinationPath = 'images/waiters/'.$waiters->id; // upload path
            $destinationPath2 = base_path() . '/public_html/images/waiters/'.$waiters->id; // upload path
            $extension = 'jpg'; // getting image extension
            $fileName = $waiters->id.'.'.$extension; // renameing image
            $request->file('url')->move($destinationPath2, $fileName); // uploading file to given path   
            $waiters->url = $destinationPath.'/'.$fileName;
        }

        $waiters->save();
        return redirect('/waiters')->with('message','Mesero Actualizado Correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $waiters = Waiters::find($id);
        $waiters->status = 0;
        $waiters->save();
        return redirect('/waiters')->with('message','Mesero Eliminado Correctamente');
    }
}
