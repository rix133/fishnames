<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Specie;
use App\Models\Estname;

class SearchController extends Controller {

    public function index(Request $request)
    {
        $search = $request->get('query');
        $showInprogress = false;
        $goto = $request->goto;
        if($goto == "species/"){
            return redirect()->route('species.index', compact('showInprogress', 'search'));
        }
        if($goto == "termeki/"){
            return redirect()->route('estnames.termeki', compact('showInprogress', 'search'));
        }
            
        return redirect()->route('species.index', compact('showInprogress', 'search'));
     }   

}