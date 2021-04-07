<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;

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
            'user_id' =>[
                'integer',
                'required'
            ]
            
        ];
    }

    public function authorize()
    {
        return Gate::allows('estname_access');
    }

    public function prepareForValidation()
    {
        $uid = Auth::user()->id;
        $this->merge(['user_id' => $uid]);
        
    }
}