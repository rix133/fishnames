<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

use App\Models\Specie;

class UpdateSpeciesRequest extends FormRequest
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
                'unique:species,latin_name,' . request()->route('species')->id,
            ],
            'new_id' =>[
                'integer',
                'nullable'
            ],
            'latin_family'    => [
                'string',
                'nullable',
            ],
            'describer'    => [
                'string',
                'nullable',
            ],
            'year_described'    => [
                'integer',
                'nullable',
            ],
        ];
    }

    public function prepareForValidation()
    {
        $this->formatSpeciesName();
        
    }

    public function authorize()
    {
        return Gate::allows('species_access');
    }

    protected function formatSpeciesName(){
        $new_name = $this->request->get("new_id");

        if(strlen($new_name) < 2 | is_null($new_name)){
            $spid = null;
        } 
        else{
            $spid = Specie::where("latin_name", $new_name)
            ->select('id')
            ->first();
            if(is_null($spid)){
                $spid = "missing";
            }
            else{
                $spid = $spid->id;
            }
        }
        
        $this->merge(['new_id' => $spid]);
        //dd($this->request);
    }
}