<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ledger extends Model
{
    protected $fillable = ['user_id','ip_address','action'];
	
    public function user(){
		return $this->belongsTo(User::class);
	}
	
	public function scopeResult($query, $search){
		return $query->where('users.complete_name', 'like' , '%'.$search.'%');
	}
}
