<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\Master as Authenticatable;

class Master extends Model
{
	use Notifiable;
	use softDeletes;
	protected $fillable = ['id'];
	
	public function user(){
		return $this->belongsTo(User::class);
	}
	
	public function address(){
        return $this->hasMany(Address::class);
    }

    public function doctorate(){
        return $this->hasMany(Doctorate::class);
    }
	
	public function elementary(){
        return $this->hasMany(Elementary::class);
    }
	
	public function high(){
        return $this->hasMany(High::class);
    }
	
	public function college(){
        return $this->hasMany(College::class);
    }
	
	public function vocational(){
        return $this->hasMany(Vocational::class);
    }
	
	public function graduate(){
        return $this->hasMany(Graduate::class);
    }
	
	public function identification(){
        return $this->hasMany(Identification::class);
    }
	
	public function father(){
        return $this->hasMany(Father::class);
    }
	
	public function mother(){
        return $this->hasMany(Mother::class);
    }
	
	public function spouse(){
        return $this->hasMany(Spouse::class);
    }
	
	public function child(){
        return $this->hasMany(Child::class);
    }
	
	public function eligibility(){
        return $this->hasMany(Eligibility::class);
    }
	
	public function work(){
        return $this->hasMany(Work::class);
    }
	
	public function voluntary(){
        return $this->hasMany(Voluntary::class);
    }
	
	public function commendation(){
        return $this->hasMany(Commendation::class);
    }
	
	public function reference(){
        return $this->hasMany(Reference::class);
    }
	
	public function credential(){
        return $this->hasMany(Credential::class);
    }
	
	public function answer(){
        return $this->hasMany(Answer::class);
    }
	
	public function issue(){
        return $this->hasMany(Issue::class);
    }
	
	public function schooling(){
        return $this->hasMany(Schooling::class);
    }
	
	public function training(){
        return $this->hasMany(Training::class);
    }
	
	public function accomplishment(){
        return $this->hasMany(Accomplishment::class);
    }
	
    public function performance(){
        return $this->hasMany(Performance::class);
    }

	public function scopeResult($query, $search){
		return $query->where('masters.complete_name', 'like' , '%'.$search.'%')
					 ->orWhere('masters.position', 'like' , '%'.$search.'%')
		             ->orWhere('masters.item_number', 'like' , '%'.$search.'%')
					 ->orWhere('masters.salary_grade', 'like' , '%'.$search.'%')
					 ->orWhere('masters.office', $search);
	}
	
	public function scopeResultchr($query, $search){
		return $query->where('masters.complete_name', 'like' , '%'.$search.'%')
					 ->orWhere('masters.position', 'like' , '%'.$search.'%')
		             ->orWhere('masters.item_number', 'like' , '%'.$search.'%')
					 ->orWhere('masters.salary_grade', 'like' , '%'.$search.'%')
					 ->orWhere('masters.office', $search);
	}
}
