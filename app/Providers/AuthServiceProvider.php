<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;//
use App\Model\User\Post;
use App\Policies\PostPolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    
    protected $policies = [
        
          App\Model\User\Post::class => App\Policies\PostPolicy::class,
          Post::class => PostPolicy::class,
          'App\Model\User\Post' => 'App\Policies\PostPolicy',

        // 'App\Model' => 'App\Policies\ModelPolicy',
        // 'App\Model\User\Comment' => 'App\Policies\CommentPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    


    public function boot()
    {

        /*3 ways to register policy
          1) the safest: guessPolicyNamesUsing() - manually type who utilize the policy with the model class
          2) through $policies array
          3) auto guess once meet standard naming/file location

          Authorize Policy
          1) user model - if($user->can('update',$post))
          2) via middleware implicit model binding - Route::POST(function(Post $post){})->middleware('can:update,post')
          3) controller method - $this->authorize('update',$post){  //do something .. }
          4) resource controllers contructor - $this->authorizeResource(Post::class,'post') 1 arg class, 2nd arg route request parameters
          5) via blade


        */

        $this->registerPolicies();

        //authorize admin in all request
        if(Auth::guard('admin')->check()){
          $user = Auth::guard(' admin')->user(); 

            Gate::before(function ($user) {
                foreach($user->role as $role){
                    if ($role->name == 'admin' || $role->name == 'editor') {  //$user->role
                        return true;
                    }
                }
            });
        }

        Gate::guessPolicyNamesUsing(function(Post $post){
            return PostPolicy::class;
        });

    }

}
