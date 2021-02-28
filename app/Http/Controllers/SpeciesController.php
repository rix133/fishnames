<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSpeciesRequest;
use App\Http\Requests\UpdateSpeciesRequest;
use App\Models\Estname;
use App\Models\Specie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class SpeciesController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('estname_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $species = Specie::with('estnames.notes.user')->get();
        foreach($species as $liik){
            foreach($liik->estnames as $estname){
                if($estname->accepted){
                    $liik->estname = $estname->est_name;
                }
            }
        }

        return view('species.index', compact('species'));
    }

    public function create()
    {
        abort_if(Gate::denies('species_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $estnames = Estname::pluck('title', 'id');

        return view('species.create', compact('estnames'));
    }

    public function store(StoreSpeciesRequest $request)
    {
        $liik = Specie::create($request->validated());
        $liik->estnames()->sync($request->input('estnames', []));

        return redirect()->route('species.index');
    }

    public function show($id)
    {
        abort_if(Gate::denies('estname_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $liik = Specie::with('estnames.notes.user')->find($id);
        return view('species.show', compact('liik'));
    }

    public function edit($id)
    {
        abort_if(Gate::denies('species_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        
        #$liik->load('estnames');
        $liik = Specie::with('estnames.notes.user')->find($id);
        return view('species.edit', compact('liik'));
    }

    public function update(UpdateSpeciesRequest $request, Specie $liik)
    {
        $liik->update($request->validated());
        $liik->estnames()->sync($request->input('estnames', []));

        return redirect()->route('species.index');
    }

    public function destroy(Specie $liik)
    {
        abort_if(Gate::denies('species_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $liik->delete();

        return redirect()->route('species.index');
    }
}
