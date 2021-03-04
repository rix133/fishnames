<?php

namespace App\Http\Controllers;

use App\Models\Estname;
use App\Models\Specie;
use Illuminate\Http\Request;
use App\Http\Requests\StoreEstnameRequest;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\Note;

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
    public function store(StoreEstnameRequest $request)
    {
        abort_if(Gate::denies('estname_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $user = Auth::user();
        $request->validated();

        $estname = Estname::create([
            'user_id' => $user->id,
            'specie_id' => $request->specie_id, 
            'est_name' => $request->est_name,
        ]);

        if(!is_null($request->note)){
            Note::create([
                'user_id' => $user->id,
                "estname_id" => $estname->id,
                "description" => $request->note,
                ]);
        }
        return redirect()->route('species.index');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Estname  $estname
     * @return \Illuminate\Http\Response
     */
    public function show(Estname $estname)
    {
        abort_if(Gate::denies('estname_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $estname->load(["notes.user", "user", "specie"]);

        return view('estnames.show', compact('estname'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Estname  $estname
     * @return \Illuminate\Http\Response
     */
    public function edit(Estname $estname)
    {
        abort_if(Gate::denies('estname_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $estname->load(["notes.user", "user", "specie"]);

        return view('estnames.edit', compact('estname'));
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
