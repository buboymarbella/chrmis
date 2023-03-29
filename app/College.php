<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class College extends Model
{
    public function master(){
        return $this->belongsTo(Master::class);
    }
}
