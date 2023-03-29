<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Costing extends Model
{
    use softDeletes;

    public function scopeResulttat($query, $search){
		return $query ->where('costings.plantilla_number', 'like' , '%'.$search.'%')
                     ->orWhere('costings.position', 'like' , '%'.$search.'%')
                     ->orWhere('costings.salary_grade', $search)
		             ->orWhere('costings.office', $search);
	}
}
