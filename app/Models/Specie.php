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
        $confirmedName  = new Estname();
        foreach($this->estnames()->get() as $estname){
            if($estname->accepted){
                $confirmedName = Estname::find($estname->id);
            }
        }

      return $confirmedName;
    }
   

}
