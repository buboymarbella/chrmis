<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Eligibility extends Model
{
    public function master(){
        return $this->belongsTo(Master::class);
    }
}
