<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    public function master(){
        return $this->belongsTo(Master::class);
    }
}
