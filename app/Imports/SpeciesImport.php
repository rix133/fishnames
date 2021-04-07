<?php

namespace App\Imports;

use App\Models\Estname;
use App\Models\Specie;
use App\Models\Source;
//use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Facades\Auth;

class SpeciesImport implements ToCollection, WithHeadingRow, WithValidation
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function collection(Collection $rows)
    {
        $user = Auth::user();
        foreach ($rows as $row) 
        {
            
            $src = Source::where("name", $row['source'])->first();
            if(is_null($src)){
                $src = Source::create([
                    'name' => $row['source'],
                    'user_id' => $user->id
                    ]);
            }

            $sp = Specie::create([
                'latin_name' => $row['latin_name'],
                'eng_name' => $row['eng_name'],
                'latin_family' => $row['latin_family'],
                'source_id' => $src->id,
                'user_id' => $user->id,
                'year_described' => $row['year_described'],
                'describer' => $row['describer'],

            ]);
            if($row['est_name']){
                $estName = Estname::create([
                    'est_name' => $row['est_name'],
                    'est_genus' => $row['est_genus'],
                    'user_id' => $user->id,
                    'specie_id' => $sp->id,
                    'accepted' => true
                ]);
                $sp->confirmed_estname_id = $estName->id;
                $sp->save();
            }

            if($row['old_est_name']){
                $estName = Estname::create([
                    'est_name' => $row['old_est_name'],
                    'est_genus' => $row['est_genus'],
                    'user_id' => $user->id,
                    'specie_id' => $sp->id,
                    'accepted' => false
                ]);
            }

            if($row['old_latin_name']){
                $sp_old = Specie::where("latin_name", $row['old_latin_name'])->first();
                #do not overwrite if exists
                if(is_null($sp_old)){
                    $sp_old = Specie::create([
                        'latin_name' => $row['old_latin_name'],
                        'eng_name' => $row['eng_name'],
                        'latin_family' => $row['latin_family'],
                        'user_id' => $user->id,
                        'source_id' => $src->id, 
                        'new_id' => $sp->id,   
                    ]);
                }
                else{
                    $sp_old->new_id = $sp->id;
                    $sp_old->save();
                }
                
            }


            
        }
        
    }
    public function  rules(): array {
        return [
            'eng_name'     => [
                'string',
                'nullable',
            ],
            'latin_name'    => [
                'required',
                'unique:species',
            ],
           'year_described' =>[
               'nullable',
               'integer'
           ]

        ];
    }
    public function prepareForValidation($row, $index)
    {
        $row['latin_name'] =  $row['latin_name'] ??
        $row['Ladinakeelne_nimi'] ?? $row['ladinakeelne_nimi'] ?? null;

        $row['eng_name'] = $row['eng_name'] ??
        $row['Inglisekeelne_nimi'] ?? $row['inglisekeelne_nimi'] ?? null;

        $row['est_name'] = $row['est_name'] ?? 
        $row['Eestikeelne_nimi'] ?? $row['eestikeelne_nimi'] ?? null;

        $row['est_genus'] = $row['est_genus'] ?? 
        $row['Eestikeelne_perekond'] ??
        $row['eestikeelne_perekond'] ?? null;

        $row['old_est_name'] = $row['old_est_name'] ?? 
        $row['vana_eestikeelne_nimi'] ?? null;

        $row['old_latin_name'] = $row['old_latin_name'] ??
        $row['Vana_ladinakeelne_nimi_eesti_allikates'] ?? 
        $row['vana_ladinakeelne_nimi_eesti_allikates'] ?? 
        $row['Vana_ladinakeelne_nimi'] ??
        $row['vana_ladinakeelne_nimi'] ?? null;

        $row['latin_family'] =  $row['latin_family'] ?? 
        $row['Sugukond'] ?? $row['sugukond'] ?? null;

        $row['source'] =  $row['source'] ?? 
        $row['Allikas'] ?? $row['allikas'] ?? null;

        $row['describer'] = $row['describer'] ??
        $row['Kirjeldaja_nimi'] ?? $row['kirjeldaja_nimi'] ?? null;

        $row['year_described'] = $row['year_described'] ??
        $row['Aasta'] ?? $row['aasta'] ?? null;



        

        return $row;
    }
}
