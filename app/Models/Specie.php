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
   

}
