<?php
namespace App\Helpers;

use Illuminate\Database\Eloquent\Collection;

class SpeciesHelper
{
    public function __construct(Collection $species)
    {
        $this->species = $species;
    }
    public function filterSpecies($filter)
    {
        switch ($filter) {
            case 'all':
                break;
            case 'confirmed':
                $this->species = $this->species->filter(function($value, $key){
                    return !is_null($value->estname);
               });
                break;
            case 'inEKI':
                $this->species = $this->species ->filter(function($value, $key){
                    return $value->inEKI;
               });
                break;
            case 'inProgress':
                $this->species = $this->species->filter(function($value, $key){
                    return is_null($value->estname);
               });
                break;
        }  
        return $this->species;
    }

    public function inProgress($show){
        if($show){
            return $this->filterSpecies("inProgress");
        }
        return $this->filterSpecies("all");
    }
    
    public static function new($sp)
    {
        return new SpeciesHelper($sp);
    }
}