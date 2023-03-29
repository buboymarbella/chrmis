<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctorate extends Model
{
    use HasFactory;

    public function master(){
        return $this->belongsTo(Master::class);
    }
}
