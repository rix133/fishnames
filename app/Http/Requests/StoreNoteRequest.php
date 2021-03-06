<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class StoreNoteRequest extends FormRequest
{
    public function rules()
    {
        return [
            'description' => [
                'required', 'string',
            ],
            'estname_id' => [
                'required', 'integer',
            ]
        ];
    }

    public function authorize()
    {
        return Gate::allows('estname_access');
    }
}