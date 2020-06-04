<?php

namespace App\Http\Controllers\User\Authenticated\Profile;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\User\Profile\ProfileValidate;
use App\Http\Controllers\Controller;
use App\Model\User\Profile;
use App\Model\User\File;
use App\Model\User\User;
use DB;

class ProfileController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('verified');
    }

    public function show(){             

        // <!-- it seem one-to-one relation does not return collection-->
        // <!-- also, in relational mapping, it seem query does not give you any error, but mapping from null to null will -->
        // <!-- ready data in the controller, do not over populate view(DRY not applied) -->


        // remember that if you want to display data in view, either fail or not, you must show a message(even an empty message)

        $profile = '';
        $active_image = ''; //for returns not undefined
        $non_active_images = '';

        if(!empty($profile = Auth::user()->profile)){
            //success

            if(!empty($active_image = $profile->files()->where('active',true)->first() )){
                //success
            }

            if(!empty($non_active_images = $profile->files()->where('active',false)->get() )){
                //success
            }

        }

        return view('user/authenticated/profile/show',compact('profile','active_image','non_active_images'));
    }
   
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, ProfileValidate $requestValidate)
    {
        $validated = $requestValidate->validated();

        $profile = new Profile;

        $profile->intro        = $request->input('intro');
        $profile->name         = Auth::user()->name;
        $profile->email        = Auth::user()->email;
        $profile->gender       = $request->input('gender');
        $profile->hobby        = $request->input('hobby');
        $profile->current_city = $request->input('current_city');
        $profile->hometown     = $request->input('hometown');
        $profile->save();


        if(!empty($profile)){

            //for later use
            $file = new File;

            if(!empty($request->file('image'))){

                $file->user_id    = Auth::user()->id;
                $file->profile_id = $profile->id;
                $file->active     =  true;
                $file->type       = 'image';
                $file->full_name  = $request->file('image')->getClientOriginalName();
                $file->mime_type  = $request->file('image')->getMimeType();
                $file->save();

/*
 The model profile wants a relationship that isn't created yet.
 Solution: relationship will be establish once the key is created.

 REMEMBER you set keys to nullable, then you can save that for later after you created the file instance.
*/                

                //check file if present
                if(!empty($file)){

                    //move file to storage path
        $move = $request->file('image')->move('storage/user/authenticated/files/'.Auth::user()->email.'/images', $file->full_name);


                    if(!empty($move)){
                        
                        //user Relation(one to one)
                        if(!empty($user = User::find(Auth::user()->id))){
                            $user->profile_id = $profile->id;
                            $user->save();
    
                            //profile relation                
                            if(!empty($user = Profile::find($profile->id))){
    
                                $profile->user_id = Auth::user()->id; 
                                $profile->file_id = $file->id;
                                $profile->save();
    
                                return redirect()->back()->with('updated','Update success');
                            }
                        }
                        return redirect()->back()->with('updated','Failed to update: not found user');
                    }
                    return redirect()->back()->with('updated','Failed to update: file store failed');
                }
            }
        
        }

        return redirect()->back()->with('updated','Update failed.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function edit(Profile $profile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Profile $profile, ProfileValidate $requestValidate)
    {
        if(!empty($validated = $requestValidate->validated())){
                
            //update profile
            $profile = Auth::user()->profile;

            $profile->intro        = $request->input('intro');
            $profile->name         = Auth::user()->name;
            $profile->email        = Auth::user()->email;
            $profile->gender       = $request->input('gender');
            $profile->hobby        = $request->input('hobby');
            $profile->current_city = $request->input('current_city');
            $profile->hometown     = $request->input('hometown');
            $profile->save();

            if(!empty($profile)){

                if(!empty($request->file('image'))){

                //add image
                    $file = new File;
                    $file->user_id    = Auth::user()->id;
                    $file->profile_id = $profile->id;
                    $file->active     = true;
                    $file->type       = 'image';
                    $file->full_name  = $request->file('image')->getClientOriginalName();
                    $file->mime_type  = $request->file('image')->getMimeType();
                    $file->save();



                    if(!empty($file)){

                        //find active file & update
                        if(!empty($updated = $profile->files()->where([
                                            ['id','!=',$file->id],
                                            ['profile_id','=',$profile->id],
                                            ['active', '=', true],
                                        ])->first() )){

                            $updated->active = false;
                            $updated->save();

                                //store file
                                //note: this is the pub folder bec it cant use symlink as free user, else move to storage folder
                                $request->file('image')->move('storage/user/authenticated/files/'.Auth::user()->email.  '/images/', $file->full_name);

                        }else{

                           //delete new file
                           if(!empty($file = File::find($file->id) )){
                                $file->delete();
                           }

                         return redirect()->back()->with('updated','Something went wrong(image failed).');
                        }            
                    }
                }
                //from here is considered success 
                 return redirect()->back()->with('updated','Update success');
            }
        }

        return redirect()->back()->with('updated','Something went wrong.');
    }

    public function update_pp($img)
    {

    //get active image
        if(!empty($active_image = Auth::user()->profile->files()->where('active',true)->first())){
    
            // update active image = false 
            if(!empty($image = File::find($active_image->id))){
                
                $image->active = false;
                $image->save();

                if(!empty($image)){

                    //get selected image
                    if(!empty($new_active_image = Auth::user()->profile->files()->where('full_name',$img)->first())){
                       
                       //update new active image
                        if(!empty($image = File::find($new_active_image->id))){

                            $image->active = true;
                            $image->save();

                            if(!empty($image)){

                                return redirect()->back()->with('updated','Update successful');
                            }
                        }
                    }   
                }
            }
        }

         return redirect()->back()->with('updated','Update failed');
            
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function destroy(Profile $profile)
    {
        //
    }
}
