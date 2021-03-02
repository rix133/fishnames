<?php

namespace App\Http\Controllers;

use App\Models\Estname;
use App\Models\Specie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

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
    public function create(Request $request)
    {
        abort_if(Gate::denies('estname_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $liik = Specie::with("estnames.notes")->find($request->get('spid'));
        $est_name = '';

        return view('estnames.create', compact('liik', 'est_name'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        abort_if(Gate::denies('estname_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $user = Auth::user();
        
        var_dump($request->specie_id);
        var_dump($request->est_name);
        var_dump($user->id);
        var_dump($request->note);
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
