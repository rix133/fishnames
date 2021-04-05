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
        return redirect()->route('species.index', ['showInprogress' => true]);
        
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
        $estname->load(["notes.user", "user", "specie","source"]);

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
        $estname->load(["notes.user", "user", "specie", "source"]);

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

     /**
     * Confirm this name as the accepted name
     *
     * @param  \numeric  $id
     * @return \Illuminate\Http\Response
     */
    public function confirm($id){

        abort_if(Gate::denies('species_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $estname = Estname::find($id);
        $estname->accepted = true;
        $estname->save();
        $species = Specie::find($estname->specie_id);
        $species->confirmed_estname_id = $estname->id;
        $species->source_id = 1; #make the name source Terminoloogiakomisjon
        $species->save();
        return redirect()->route('species.index');
    }

    /**
     * Confirm this name is in termeki
     *
     * @param  \numeric  $id
     * @return \Illuminate\Http\Response
     */
    public function finish($id){

        abort_if(Gate::denies('species_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $estname = Estname::find($id);
        $estname->in_termeki = true;
        $estname->save();
        return redirect()->route('estnames.termeki');
    }

    /**
     * Show termeki table
     *
     * @return \Illuminate\Http\Response
     */
    public function termeki(Request $request){

        abort_if(Gate::denies('species_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        
        $searchString = $request->get('search'); 
        $showInprogress = $request->showInprogress;
        if(strlen($searchString) == 0){
            $estnames = Estname::with('specie')->where('accepted', true)->get();
        }
        else{
            $estnames = Estname::with('specie')
            ->where('est_name', 'LIKE', "%$searchString%")
            ->where('accepted', true)->get(); 
        }
        
        return view('estnames.termeki', compact('estnames'));
    }

      /**
     * Save this name is in termeki
     *
     * @param  \Request  $request
     * @return \Illuminate\Http\Response
     */
    public function savetermeki(Request $request){
        abort_if(Gate::denies('species_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $ids = $request->input('in_termeki');
        if(is_null($ids)) {$ids = [];}
        $estnames = Estname::where('accepted', true)->get();
        foreach($estnames as $name){
            if(in_array($name->id, $ids)){
                $name->in_termeki = true;
            }
            else{
                $name->in_termeki = false; 
            }
            $name->save();
        } 
        return redirect()->route('species.index');
    }
}
