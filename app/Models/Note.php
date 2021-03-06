<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Note extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'description',
        'user_id',
        'estname_id',
    ];


public function user()
    {
        return $this->belongsTo(User::class)->withTrashed();
    }

    public function estname()
    {
        return $this->belongsTo(Estname::class);
    }
}

