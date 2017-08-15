<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use Redirect;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;
use App\SocialNetworks;

class SocialNetworksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $socialnetworks = SocialNetworks::paginate(10);
        return view('data.socialnetworks.index', ['socialnetworks'=>$socialnetworks]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('data.socialnetworks.create');
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
            'facebook' => 'required|max:255',
            'twitter' => 'required|max:255',
            'linkedin' => 'required|max:255',
        ]);

        $socialnetworks = new SocialNetworks;
        $socialnetworks->fill($request->all());
        $socialnetworks->save();
        return redirect('/socialnetworks')->with('message','Redes Sociales Registradas Correctamente');
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
        $socialnetworks = SocialNetworks::find($id);
        return view('data.socialnetworks.edit', ['socialnetworks'=>$socialnetworks]);
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
            'facebook' => 'required|max:255',
            'twitter' => 'required|max:255',
            'linkedin' => 'required|max:255',
        ]);

        $socialnetworks = SocialNetworks::find($id);
        $socialnetworks->fill($request->all());
        $socialnetworks->save();
        return redirect('/socialnetworks')->with('message','Redes Sociales Actualizadas Correctamente');
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
