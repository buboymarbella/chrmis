<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
	protected $fillable = ['master_id'];
	
    public function master(){
        return $this->belongsTo(Master::class);
    }
}
