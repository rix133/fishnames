<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class UpdateSpeciesRequest extends FormRequest
{
    public function rules()
    {
        return [
            'eng_name'     => [
                'string',
            ],
            'latin_name'    => [
                'required',
                'unique:species,latin_name,' . request()->route('species')->id,
            ],
            'estnames.id'  => [
                'integer',
            ],
            'source_id' => [
                'integer',
            ]
        ];
    }

    public function authorize()
    {
        return Gate::allows('species_access');
    }
}