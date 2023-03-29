<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Graduate extends Model
{
    public function master(){
        return $this->belongsTo(Master::class);
    }
}
