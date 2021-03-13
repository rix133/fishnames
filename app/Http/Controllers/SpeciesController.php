<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSpeciesRequest;
use App\Http\Requests\UpdateSpeciesRequest;
use App\Models\Estname;
use App\Models\Specie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;
use App\Helpers\SpeciesHelper;

class SpeciesController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('estname_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        
        $showInprogress = $request->showInprogress;
        if($showInprogress){
            $species = Specie::with('estnames.notes.user')
            ->where("confirmed_estname_id", null)
            ->get();   
        }
        else{
            $species = Specie::with('estnames.notes.user')->get();
        }

        foreach($species as $specie){
            $specie->estname = $specie->estname()->est_name;
        }
        //$species = SpeciesHelper::new($species)->inProgress($showInprogress);
        

        return view('species.index', compact('species', 'showInprogress'));
    }

    public function create()
    {
        abort_if(Gate::denies('species_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $estnames = Estname::pluck('title', 'id');

        return view('species.create', compact('estnames'));
    }

    public function store(StoreSpeciesRequest $request)
    {
        $species = Specie::create($request->validated());
        $species->estnames()->sync($request->input('estnames', []));

        return redirect()->route('species.index', ['showInprogress' => true]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Specie  $specie
     * @return \Illuminate\Http\Response
     */
    public function show(Specie $species)
    {
        abort_if(Gate::denies('estname_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        
        $species -> load('estnames.notes.user');

        return view('species.show', compact('species'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Specie  $specie
     * @return \Illuminate\Http\Response
     */
    public function edit(Specie $species)
    {
        abort_if(Gate::denies('species_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        
        $species->load('estnames');

        return view('species.edit', compact('species'));
    }

    public function update(UpdateSpeciesRequest $request, Specie $species)
    {
        $species->update($request->validated());
        #$species->estnames()->sync($request->input('estnames', []));

        return redirect()->route('species.index', ['showInprogress' => true]);
    }

    public function destroy(Specie $species)
    {
        abort_if(Gate::denies('species_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $species->delete();

        return redirect()->route('species.index');
    }

    public function reset_estnames($id)
    {
        abort_if(Gate::denies('species_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        Estname::where('specie_id', $id)
        ->where('accepted', true)
        ->update(['accepted' => false]);

        $sp = Specie::find($id);
        $sp->confirmed_estname_id = null;
        $sp->save();     

        return redirect()->route('species.index', ['showInprogress' => true]);
    } 
}
