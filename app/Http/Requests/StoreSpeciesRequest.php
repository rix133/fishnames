<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class StoreSpeciesRequest extends FormRequest
{
    public function rules()
    {
        return [
            'eng_name'     => [
                'string',
                'nullable',
            ],
            'latin_name'    => [
                'required',
                'unique:species',
            ],
            'latin_family'    => [
                'string',
            ],
            'describer'    => [
                'string',
            ],
            'year_described'    => [
                'integer',
            ],
            'source_id'    => [
                'integer',
                'nullable',
            ],
            
        ];
    }

    public function authorize()
    {
        return Gate::allows('species_access');
    }
}