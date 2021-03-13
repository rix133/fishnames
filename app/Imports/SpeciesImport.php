<?php

namespace App\Imports;

use App\Models\Estname;
use App\Models\Specie;
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
            $sp = Specie::create([
                'latin_name' => $row['latin_name'],
                'eng_name' => $row['eng_name']
            ]);
            if($row['est_name']){
                $estName = Estname::create([
                    'est_name' => $row['est_name'],
                    'user_id' => $user->id,
                    'specie_id' => $sp->id,
                    'accepted' => true
                ]);
                $sp->confirmed_estname_id = $estName->id;
                $sp->save();
            }
            
        }
        
    }
    public function  rules(): array {
        return [
            'eng_name'     => [
                'string',
            ],
            'latin_name'    => [
                'required',
                'unique:species',
            ],
            'estnames.id'  => [
                'integer',
            ],
        ];
    }
    public function prepareForValidation($row, $index)
    {
        $row['latin_name'] =  $row['latin_name'] ?? $row['ladinakeelne_nimi'] ?? null;
        $row['eng_name'] = $row['eng_name'] ?? $row['ingliskeelne_nimi'] ?? null;
        $row['est_name'] = $row['est_name'] ?? $row['eestikeelne_nimi'] ?? null;
        
        return $row;
    }
}
