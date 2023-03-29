<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Spouse extends Model
{
	protected $fillable = ['id','master_id'];
							
    public function master(){
        return $this->belongsTo(Master::class);
    }
}
