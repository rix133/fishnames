<?php

namespace App\Exports;

use App\Models\Specie;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
//use PhpOffice\PhpSpreadsheet\Shared\Date;
use App\Helpers\SpeciesHelper;

class SpeciesExport implements FromCollection,WithHeadings,WithMapping
{
    protected $request;
    public function __construct($request)
    {
       $this->request = $request;
    } 
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        
        $species = Specie::all();
        $filter = $this->request->get('download-filter');
        $species = SpeciesHelper::new($species)->filterSpecies($filter);
        
        return $species;
    }

    public function headings():array
    {
        return [
         "ladinakeelne nimi",
         "eestikeelne nimi",
         "sugukond",
         "allikas",
         "ingliskeelne nimi", 
         "kirjeldaja nimi",
         'kirjeldamise aasta',
         "termekis olemas",
         "viimane muutmine"
        ];
    }

    /**
     * @param Specie $sp
     *
     * @return array
     */
    public function map($sp): array
    {
        if($sp->source){
            $sourceName = $sp->source->name;
        }
        else{
            $sourceName = "" ;
        }
        
        return [
            $sp->latin_name,
            $sp->estname()->est_name,
            $sp->latin_family,
            $sourceName,
            $sp->eng_name,
            $sp->describer,
            $sp->year_described,
            //Date::dateTimeToExcel($sp->confirmed),
            $sp->inEKI,
            $sp->confirmed_at
        ];
    }


}
