<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Plantilla extends Model
{
    use HasFactory;

    use Notifiable;
	use softDeletes;
	protected $fillable = ['id'];

    public function scopeResult($query, $search){
		return $query->where('complete_name', 'like' , '%'.$search.'%')
					 ->orWhere('plantilla_number', 'like' , '%'.$search.'%')
                     ->orWhere('title', 'like' , '%'.$search.'%')
		             ->orWhere('office', $search)
					 ->orWhere('staff_action', 'like' , '%'.$search.'%')
					 ->orWhere('sourcing_method', 'like' , '%'.$search.'%');
	}

	public function scopeResultplantilla($query, $search){
		return $query->where('complete_name', 'like' , '%'.$search.'%')
					 ->orWhere('plantilla_number', 'like' , '%'.$search.'%')
                     ->orWhere('title', 'like' , '%'.$search.'%')
		             ->orWhere('office', $search)
					 ->orWhere('sg', 'like' , '%'.$search.'%')
					 ->orWhere('eligibility', 'like' , '%'.$search.'%');
	}
}
