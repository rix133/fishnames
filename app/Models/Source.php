<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Source extends Model
{
    use SoftDeletes;
    use HasFactory;
       /**
   * The attributes that aren't mass assignable.
   *
   * @var array
   */
   protected $guarded = [];

   public function estnames(){
    return $this->hasMany(Estname::class);
   }

   public function species(){
        return $this->belongsToMany(Specie::class);
   }
}

