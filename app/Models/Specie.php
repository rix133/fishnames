<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Specie extends Model
{
    use HasFactory;

   /**
   * The attributes that aren't mass assignable.
   *
   * @var array
   */
   protected $guarded = [];

   public function estnames()
    {
        return $this->hasMany(Estname::class);
    }


    public function estname()
    {
        
        $eid = $this->confirmed_estname_id;
        if(!is_null($eid)){
         $confirmedName = Estname::find($eid);
        }
        else{
          $confirmedName  = new Estname();
        }

      return $confirmedName;
    }

    public function sources(){
      return $this->belongsToMany(Source::class);
    }

    public function newName(){
      $new_name = "";
      if(!is_null($this->new_id)){
        $sp = Specie::find($this->new_id);
        $new_name = $sp->latin_name;
      }
      return $new_name;
    }
   

}
