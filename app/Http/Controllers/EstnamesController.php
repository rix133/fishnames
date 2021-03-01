<?php

namespace App\Http\Controllers;

use App\Models\Estname;
use Illuminate\Http\Request;

class EstnamesController extends Controller
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Estname  $estname
     * @return \Illuminate\Http\Response
     */
    public function show(Estname $estname)
    {
        var_dump($estname->load("notes"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Estname  $estname
     * @return \Illuminate\Http\Response
     */
    public function edit(Estname $estname)
    {
        return $this->show($estname);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Estname  $estname
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Estname $estname)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Estname  $estname
     * @return \Illuminate\Http\Response
     */
    public function destroy(Estname $estname)
    {
        //
    }
}
