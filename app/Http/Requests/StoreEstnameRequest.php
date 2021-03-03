<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class StoreEstnameRequest extends FormRequest
{
    public function rules()
    {
        return [
            'est_name'     => [
                'string',
                'required',
            ],
            'specie_id'    => [
                'required',
            ],
        ];
    }

    public function authorize()
    {
        return Gate::allows('estname_access');
    }
}