<?php
namespace App\Helpers;

use Illuminate\Database\Eloquent\Collection;

use App\Models\Estname;
use App\Models\Specie;

class SpeciesHelper
{
    public function __construct(Collection $species)
    {
        foreach($species as $specie){
            $et = $specie->estname();
            $specie->confirmed_at = $et->updated_at;
            $specie->inEKI = $et->in_termeki;
        }
        $this->species = $species;
    }
    public function filterSpecies($filter)
    {
        switch ($filter) {
            case 'all':
                break;
            case 'confirmed':
                $this->species = $this->species->filter(function($value, $key){
                    return !is_null($value->confirmed_estname_id);
               });
                break;
            case 'inEKI':
                $this->species = $this->species ->filter(function($value, $key){
                    return $value->inEKI;
               });
                break;
            case 'toEKI':
                $this->species = $this->species ->filter(function($value, $key){
                        return !$value->inEKI & !is_null($value->confirmed_estname_id);
                });
                break;
            case 'inProgress':
                $this->species = $this->species->filter(function($value, $key){
                    return is_null($value->confirmed_estname_id) & is_null($value->new_id);
               });
               break;
            case 'old':
                $this->species = $this->species->filter(function($value, $key){
                    return !is_null($value->new_id);
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

    public static function search($showInprogress, $searchString){
        $species = Specie::query();

        if($showInprogress){
            $species = $species->whereNull('confirmed_estname_id')
           ->whereNull('new_id');
       }

        if(strlen($searchString) == 0){
            $species = $species->with('estnames.notes.user');
  
        }
        else{
            $est_id = Estname::where('est_name', 'LIKE', "%$searchString%")
            ->select("specie_id")->get();
        
        $species = $species->where('latin_name', 'LIKE', "%$searchString%")
            ->orWhere('eng_name', 'LIKE', "%$searchString%")
            ->orWhereIn('id', $est_id)
            ->with(['estnames.notes.user']);
        }
        

        return $species->paginate(20);

    }
}

