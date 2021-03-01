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

    public function authorize()
    {
        return Gate::allows('species_access');
    }
}