<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    public function master(){
        return $this->belongsTo(Master::class);
    }
}
