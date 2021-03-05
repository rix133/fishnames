<?php

namespace App\Exports;

use App\Specie;
use Maatwebsite\Excel\Concerns\FromCollection;

class SpeciesExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Specie::all();
    }
}
