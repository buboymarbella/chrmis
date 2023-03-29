<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Commendation extends Model
{
    public function master(){
        return $this->belongsTo(Master::class);
    }
}
