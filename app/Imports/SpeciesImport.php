<?php

namespace App\Imports;

use App\Models\Specie;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class SpeciesImport implements ToModel, WithHeadingRow, WithValidation
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Specie([
            'latin_name' => $row['latin_name'],
            'eng_name' => $row['eng_name']
            ]); 
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
        
        return $row;
    }
}
