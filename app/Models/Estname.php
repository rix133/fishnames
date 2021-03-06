<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estname extends Model
{
    use HasFactory;
   /**
   * The attributes that aren't mass assignable.
   *
   * @var array
   */
  protected $guarded = [];

  public function notes()
   {
       return $this->hasMany(Note::class);
   }

   public function specie()
   {
       return $this->belongsTo(Specie::class);
   }

   public function user()
    {
        return $this->belongsTo(User::class)->withTrashed();
    }

    public function source(){
        return $this->belongsTo(Source::class);
      }

    
}
