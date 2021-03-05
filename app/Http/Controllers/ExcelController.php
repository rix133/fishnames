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
    public function export() 
    {
        abort_if(Gate::denies('estname_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return Excel::download(new SpeciesExport, 'species.xlsx');
    }
     
    /**
    * @return \Illuminate\Support\Collection
    */
    public function import() 
    {
        abort_if(Gate::denies('species_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        Excel::import(new SpeciesImport,request()->file('file'));
             
        return back();
    }
}
