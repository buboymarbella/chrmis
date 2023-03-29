<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
	
	protected $fillable = ['id','master_id','employee_number','residential_house','residential_street','residential_subdivision','residential_brgy','residential_city','residential_province',
							'residential_zipcode','permanent_house','permanent_street','permanent_subdivision','permanent_brgy','permanent_city','permanent_province','permanent_zipcode'];
							
    public function master(){
        return $this->belongsTo(Master::class);
    }
	
	public function adds(){
        return $this->morphTo();
    }
}
