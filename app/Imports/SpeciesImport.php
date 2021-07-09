<?php

namespace App\Imports;

use App\Models\Estname;
use App\Models\Specie;
use App\Models\Source;
use App\Models\Note;
//use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

//use Maatwebsite\Excel\Concerns\WithChunkReading;
//use Illuminate\Contracts\Queue\ShouldQueue;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class SpeciesImport implements ToCollection, WithHeadingRow, WithValidation
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function collection(Collection $rows)
    {
        $user = Auth::user();
        foreach ($rows as $row) 
        {
            if(is_null($row['latin_name'])){
                continue;
            }
            $addNote = false;
            $source_ids = $this->getSources($row, $user);
            $sp = Specie::where("latin_name", $row['latin_name'])->first();
            #do not overwrite if exists
            if(is_null($sp)){
                $sp = Specie::create([
                    'latin_name' => $row['latin_name'],
                    'eng_name' => $row['eng_name'],
                    'latin_family' => $row['latin_family'],
                    'user_id' => $user->id,
                    'year_described' => $row['year_described'],
                    'describer' => $row['describer'],
                ]);
                
            }
            else{
                #only if this has been a old name
                if(!is_null($sp->new_id)){
                    $row['old_sp_name'] = Specie::find($sp->new_id)->latin_name;
                $sp->update([
                    'eng_name' => $row['eng_name'],
                    'latin_family' => $row['latin_family'],
                    'user_id' => $user->id,
                    'year_described' => $row['year_described'],
                    'describer' => $row['describer'],
                    'new_id' => null
                ]);
               $addNote = true; 
                }
                
            }
            $sp->sources()->sync($source_ids);
            
                
            if($row['est_name']){
                $estNames = explode("e.", $row['est_name']);
                foreach ($estNames as $name) {
                    $name = trim($name);
                    $this->insertEstName($name, $row, $user, $sp);
                }
                
            }

            if($row['old_est_name']){
                $this->insertOldEstName($row, $user, $sp);
            }

            if($row['old_latin_name']){
                $this->insertOldLatinName($row, $user, $sp);
            }

            if($addNote){
                $this->addLatinSpeciesNote($row, $user, $sp);
            }


            
        }
        
    }

    protected function addLatinSpeciesNote($row, $user, $sp){
        $estName = Estname::where("est_name", $row['est_name'])->first();
        if(is_null($estName)){ 
        }
        else{
            Note::create([
                'user_id' => $user->id,
                'estname_id' => $estName->id,
                'description' => "".$sp->latin_name." on ka liigi ".$row['old_sp_name']."  kehtetu nimi"
            ]);
        }
    }


    protected function insertEstName($name, $row, $user, $sp){
        $inTermeki = true;
        if($row['updated_year']){
            $date =  Carbon::createFromDate($row['updated_year'], $row['updated_month'], $row['updated_day']);
            if($row['updated_year'] > 2019){
                $inTermeki = false;
            }
        }
        $estName = Estname::where("est_name", $name)->first();
        if(is_null($estName)){
            $estName = Estname::create([
                'est_name' => $name,
                'est_genus' => $row['est_genus'],
                'user_id' => $user->id,
                'specie_id' => $sp->id,
                'accepted' => true,
                'in_termeki'=>$inTermeki,
            ]);
        }
        else{
            if(!$estName->accepted){
                Note::create([
                    'user_id' => $user->id,
                    'estname_id' => $estName->id,
                    'description' => $name." esineb ka liigi ".$estName->specie->latin_name." vana nimena"
                ]);
                $estName->update(
                    [
                        'est_name' => $name,
                        'est_genus' => $row['est_genus'],
                        'user_id' => $user->id,
                        'specie_id' => $sp->id,
                        'accepted' => true,
                        'in_termeki'=>$inTermeki,
                    ]
                    );
            }
            else{
                Note::create([
                    'user_id' => $user->id,
                    'estname_id' => $estName->id,
                    'description' => $name." on liikidel ".$estName->specie->latin_name." ja ".$sp->latin_name." põhi nimena!"
                ]); 
            }
            
        }

        if($row['updated_year']){
            $sp->updated_at = $date;
            $estName->updated_at = $date;
            $estName->save();
        }
        
        $sp->confirmed_estname_id = $estName->id;
        $sp->save();
    }

    protected function insertOldEstName($row, $user, $sp){
        $estNames = explode(", ", $row['old_est_name']);
        foreach ($estNames as $name) {
            $name = trim($name);
            $estName_old = Estname::where("est_name", $name)->first();
            if(is_null($estName_old)){
                $estName_old = Estname::create([
                    'est_name' => $name,
                    'est_genus' => $row['est_genus'],
                    'user_id' => $user->id,
                    'specie_id' => $sp->id,
                    'accepted' => false
                ]); 
            }
            else{
                Note::create([
                    'user_id' => $user->id,
                    'estname_id' => $estName_old->id,
                    'description' => $name." esineb ka liigi ".$sp->latin_name." vana nimena"
                ]);
            }
        }

        
    }

    protected function insertOldLatinName($row, $user, $sp){
        $latinNames = explode(", ", $row['old_latin_name']);
        foreach ($latinNames as $name) {
            $name = trim($name);
            $sp_old = Specie::where("latin_name", $name)->first();
            #do not overwrite if exists
            if(is_null($sp_old)){
                $sp_old = Specie::create([
                    'latin_name' => $name,
                    'eng_name' => $row['eng_name'],
                    'latin_family' => $row['latin_family'],
                    'user_id' => $user->id,
                    'new_id' => $sp->id,   
                ]);
            }
            else{
                $sp_old->new_id = $sp->id;
                $sp_old->save();
            }
        }
                
    }

    protected function getSources($row, $user){
        $source_ids = [];
      
        if(is_null($row['source'])){
            #this in unknown
            array_push( $source_ids, 4);
        }
        else{
            $sourceNames = explode(",", $row['source']);
            

            foreach ($sourceNames as $key => $srcName) {
                $srcName = trim($srcName);
                $src = Source::where("name", $srcName)->first();
                if(is_null($src)){
                    $src = Source::create([
                        'name' => $srcName,
                        'user_id' => $user->id
                        ]); 
                }
                array_push( $source_ids, $src->id);
            }     
        }
        
        return $source_ids;   
                
    }



    public function  rules(): array {
        return [
            'eng_name'     => [
                'string',
                'nullable',
            ],
            'latin_name'    => [
                'unique:species,latin_name',
            ],
           'year_described' =>[
               'nullable',
               'integer'
           ],
           'updated_year' =>[
            'nullable',
            'integer',
            'max:'.(date('Y')+1)
        ]


        ];
    }
    public function prepareForValidation($row, $index)
    {
        $row['latin_name'] =  $row['latin_name'] ?? $row['ladinakeelne_nimi'] ?? null;

        $row['eng_name'] = $row['eng_name'] ??
        $row['ingliskeelne_nimi'] ?? $row['inglisekeelne_nimi'] ?? null;

        $row['est_name'] = $row['est_name'] ?? 
        $row['eesti_nimi'] ?? $row['eestikeelne_nimi'] ?? null;

        $row['est_genus'] = $row['est_genus'] ?? 
        $row['eestikeelne_perekond'] ?? null;

        $row['old_est_name'] = $row['old_est_name'] ?? 
        $row['vana_eestikeelne_nimi'] ?? null;

        $row['old_latin_name'] = $row['old_latin_name'] ??
        $row['vana_ladinakeelne_nimi_eesti_allikates'] ?? 
        $row['vana_ladinakeelne_nimi'] ?? null;

        $row['latin_family'] =  $row['latin_family'] ?? 
        $row['ladinakeelne_sugukond'] ?? $row['sugukond'] ?? null;

        $row['source'] =  $row['source'] ?? 
        $row['Allikas'] ?? $row['allikas'] ?? null;

        $row['describer'] = $row['describer'] ??
        $row['kirjeldaja'] ?? $row['kirjeldaja_nimi'] ?? null;

        $row['year_described'] = $row['year_described'] ??
        $row['kirjeldamise_aasta'] ?? $row['aasta'] ?? null;

        $row['updated_year'] = $row['toimaasta'] ?? null;
        $row['updated_month'] = $row['tkuu'] ?? null;
        $row['updated_day'] = $row['tkuupaev'] ?? null;
        $row['change_type'] = $row['kirje_muutmine'] ?? null;
          

        return $row;
    }
}
