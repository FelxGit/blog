<?php

namespace App\Policies;

use App\Model\User\User;
use App\Model\User\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return voidasdasd
     */


//diff between ($post) and (Post $post) is that (Post $post) only accepts model from post
//arg1(user model) automatically find the current user
//arg1 must be user, and arg 2 the subject instance

    public function edit(User $user,Post $post){
        
        return $user->id == $post->user_id;
        
        // return true;

    }

    public function delete(User $user, Post $post){

        return Auth::user()->id == $post->user_id;
        // return true;
    }
}
