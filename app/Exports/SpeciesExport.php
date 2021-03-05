<?php

namespace App\Exports;

use App\Models\Specie;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Shared\Date;

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
        foreach($species as $specie){
            $et = $specie->estname();
            $specie->estname = $et->est_name;
            $specie->confirmed = $et->updated_at;
            $specie->inEKI = $et->in_termeki;
        }

        switch ($this->request->get('download-filter')) {
            case 'all':
                break;
            case 'confirmed':
                $species = $species->filter(function($value, $key){
                    return !is_null($value->estname);
               });
                break;
            case 'inEKI':
                $species = $species->filter(function($value, $key){
                    return $value->inEKI;
               });
                break;
            case 'inProgress':
                $species = $species->filter(function($value, $key){
                    return is_null($value->estname);
               });
                break;
        }  
        
        return $species;
    }

    public function headings():array
    {
        return [
         "ladinakeelne nimi",
         "ingliskeelne nimi", 
         "eestikeelne nimi",
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
        return [
            $sp->latin_name,
            $sp->eng_name,
            $sp->estname,
            //Date::dateTimeToExcel($sp->confirmed),
            $sp->inEKI,
            $sp->confirmed
        ];
    }


}
