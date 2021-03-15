<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Specie;
use App\Models\Estname;

class SearchController extends Controller {

    public function index(Request $request)
    {
        $query = $request->get('query');

        $est_id= Estname::where('est_name', 'LIKE', "%$query%")
            ->select("specie_id")->get();
        
        $species = Specie::where('latin_name', 'LIKE', "%$query%")
            ->orWhere('eng_name', 'LIKE', "%$query%")
            ->orWhereIn('id', $est_id)
            ->with('estnames.notes.user')
            ->get();
        
            foreach($species as $specie){
                $specie->estname = $specie->estname()->est_name;
            }

            $showInprogress = true;
            
            return view('species.index', compact('species', 'showInprogress'));
    }   

}