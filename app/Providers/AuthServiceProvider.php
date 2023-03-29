<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\User;
use Auth;
use App\Policies\AdminPolicy;


class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
         // 'App\Model' => 'App\Policies\ModelPolicy',
		User::class => AdminPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
		
		\Gate::define('isAdmin', function(User $user){
			return $user->acc_lvl == 'Administrator';
		});
		
		\Gate::define('is',function($user,$user_id) {
			//return in_array($user->email, ['reynolds.ervin@example.net']);
			if($user->acc_lvl == 'Administrator' || $user->email == $user_id->email){
				return true;
			}else{
				// return $user->email === $user_id->email;
				return false;
			}
		});

		\Gate::define('isManager',function($user,$user_id) {
			//return in_array($user->email, ['reynolds.ervin@example.net']);
			if($user->acc_lvl == 'Administrator' || $user->acc_lvl == 'Manager' && $user->acc_lvl != 'User'){
				return true;
			}else{
				// return $user->email === $user_id->email;
				return false;
			}
		});
		
		\Gate::define('isIsafp', function(User $user){
			
			if($user->acc_lvl == 'Administrator' ||  $user->office === "ISAFP"){
				return true;
			}else{
				return false;
			}
		});

		\Gate::define('iss', function($user){
			$users = \App\User::where('id',Auth::user()->id)->first();
			return $user->office == Auth::user()->office;
		});
    }
}
