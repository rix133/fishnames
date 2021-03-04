<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNoteRequest;
use App\Http\Requests\UpdateNoteRequest;
use App\Models\Note;
use App\Models\Estname;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class NotesController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('estname_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        //$notes = Note::with('estname.specie')->get();

        return redirect()->route('species.index', ['showInprogress' => true]);
    }

    public function create()
    {
        abort_if(Gate::denies('estname_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('notes.create');
    }

    public function store(StoreNoteRequest $request)
    {
        abort_if(Gate::denies('estname_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');      
        $note =  new Note($request->validated());
        $note->user_id = Auth::user()->id;
        $note->save();

        return redirect()->back();
    }

    public function show(Note $note)
    {
        abort_if(Gate::denies('estname_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('notes.show', compact('note'));
    }

    public function edit(Note $note)
    {
        abort_if(Gate::denies('estname_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $estname = Estname::find($note->estname_id);
        $estname->load(["notes.user", "user", "specie"]);

        return view('estnames.edit', compact('estname', 'note'));
    }

    public function update(UpdateNoteRequest $request, Note $note)
    {
        abort_if(Gate::denies('estname_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        //only creators can edit notes
        if(Auth::user()->id == $note->user_id){
            $note->update($request->validated());
        }

        return redirect()->back();
    }

    public function destroy(Note $note)
    {
        abort_if(Gate::denies('estname_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        //only creators can delete notes
        if(Auth::user()->id == $note->user_id){
            $note->delete();
        }

        return redirect()->back();
    }
}
