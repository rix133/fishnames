<?php

namespace App\Http\Controllers;
    
use Illuminate\Http\Request;
use App\Exports\SpeciesExport;
use App\Imports\SpeciesImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class ExcelController extends Controller
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function importExportView()
    {
        abort_if(Gate::denies('estname_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('excel.import-export');
    }
     
    /**
    * @return \Illuminate\Support\Collection
    */
    public function export(Request $request) 
    {
        abort_if(Gate::denies('estname_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        //$user = Auth::user();
        $fname = 'species-'. date('Y-m-d') . '.xlsx';
        return Excel::download(new SpeciesExport($request), $fname);
    }
     
    /**
    * @return \Illuminate\Support\Collection
    */
    public function import() 
    {
        abort_if(Gate::denies('species_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        
        try {
            Excel::import(new SpeciesImport,request()->file('file'));
         }
         catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            $failures = $e->failures();
            return view('excel.import-export', compact('failures'));
         }
                     
         return redirect()->route('species.index', ['showInprogress' => false]);
    }
}
