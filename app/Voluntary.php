<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Voluntary extends Model
{
    public function master(){
        return $this->belongsTo(Master::class);
    }
}
