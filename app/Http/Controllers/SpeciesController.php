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
        foreach($species as $specie){
            foreach($specie->estnames as $estname){
                if($estname->accepted){
                    $specie->estname = $estname->est_name;
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
        $specie = Specie::create($request->validated());
        $specie->estnames()->sync($request->input('estnames', []));

        return redirect()->route('species.index');
    }

       /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        abort_if(Gate::denies('estname_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        
        $liik = Specie::with('estnames.notes.user')->find($id);

        return view('species.show', compact('liik'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        abort_if(Gate::denies('species_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return $this->show($id);
    }

    public function update(UpdateSpeciesRequest $request, Specie $specie)
    {
        $specie->update($request->validated());
        $specie->estnames()->sync($request->input('estnames', []));

        return redirect()->route('species.index');
    }

      /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        abort_if(Gate::denies('species_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $liik = Specie::find($id);
        $liik->delete();

        return redirect()->route('species.index');
    }
}
