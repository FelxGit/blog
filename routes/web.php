<?php

use Illuminate\Support\Facades\Auth; 
use Illuminate\Http\Request;
use App\Model\User\User;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Open Files
Auth::routes(['verify' => true]);

Route::group(['namespace' => 'Open'], function(){

  Route::get('/', 'HomeController@index')->name('home');
  
  Route::get('contact','Contact\ContactController@showContactForm')->name('contact');
  Route::post('contact/send','Contact\ContactController@send')->name('contact.send');

  Route::get('about','About\AboutController@index')->name('about');

});


//User routes
Route::group(['namespace' => 'User'], function(){

// Authenticationentication Routes...
  Route::get('login','Authentication\LoginController@showLoginForm')->name('login');
  
  Route::post('login', [
    'as' => '',
    'uses' => 'Authentication\LoginController@login'
  ]);
  Route::post('logout', [
    'as' => 'logout',
    'uses' => 'Authentication\LoginController@logout'
  ]);

// Password Reset Routes...
  Route::get('password/reset', [
    'as' => 'password.request',
    'uses' => 'Authentication\ForgotPasswordController@showLinkRequestForm'
  ]);
  Route::post('password/email', [
    'as' => 'password.email',
    'uses' => 'Authentication\ForgotPasswordController@sendResetLinkEmail'
  ]);
  Route::get('password/reset/{token}', [
    'as' => 'password.reset',
    'uses' => 'Authentication\ResetPasswordController@showResetForm'
  ]);
  Route::post('password/reset', [
    'as' => 'password.update',
    'uses' => 'Authentication\ResetPasswordController@reset'
  ]);

// Registration Routes...
  Route::get('register', [
    'as' => 'register',
    'uses' => 'Authentication\RegisterController@showRegistrationForm'
  ]);
  Route::post('register', [
    'as' => '',
    'uses' => 'Authentication\RegisterController@register'
  ]);

  //Verify Routes
    Route::get('email/verify', 'Authentication\VerificationController@show')->name('verification.notice');
    
    Route::get('email/verify/{id}', 'Authentication\VerificationController@verify')->name('verification.verify');
    
    Route::get('email/resend', 'Authentication\VerificationController@resend')->name('verification.resend');

    Route::group(['namespace' => 'Authenticated'],function(){

      Route::get('home','HomeController@home')->name('user.home');

    });

    Route::group(['namespace' => 'Authenticated\Profile'],function(){
//Profile
      Route::resource('profile','ProfileController')
      ->except(['index','create','show','edit'])
      ->names([
        'store'  => 'user.profile.store',
        'update' => 'user.profile.update',
        'destroy'=> 'user.profile.destroy',
      ]);

      Route::get('profile','ProfileController@show')->name('user.profile');
      Route::put('profile/update_pp/{img}','ProfileController@update_pp')->name('user.profile.update_pp');


    });

    Route::group(['namespace' => 'Authenticated\Post'],function(){
//Post
      Route::resource('post','PostController')
      ->except('index')
      ->names([
        'create'  => 'user.post.create',
        'store'   => 'user.post.store',
        'show'    => 'user.post.show',
        'edit'    => 'user.post.edit',
        'update'  => 'user.post.update',
        'destroy' => 'user.post.destroy',
      ]);

      //comment
            Route::group(['namespace' => 'Comment'],function(){

              Route::post('blog/comment/store/{post_id}','CommentController@store')->name('user.comment.store');
                        
                  //like      
                    Route::group(['namespace' => 'Like'], function(){
                      Route::post('comment/like','LikeController@like')->name('user.comment.like.store');
                      Route::delete('comment/like/delete/{id}','LikeController@delete')->name('user.comment.like.delete');
                    });
            });
    
    });
    
});


/*----------------------------------------------------------------------------------------*/
//Admin routes
Route::group(['namespace' => 'Admin'], function(){

   //admin/authentication
    Route::group(['namespace' => 'Authentication'], function(){

      // Registration Routes...
        Route::get('admin/register', [
          'as' => 'admin.register',
          'uses' => 'RegisterController@showRegistrationForm'
        ]);
        Route::post('admin/register', [
          'as' => '',
          'uses' => 'RegisterController@register'
        ]);

        // Authentication Routes...
        Route::get('admin/login', [
          'as' => 'admin.login',
          'uses' => 'LoginController@showLoginForm'
        ]);
        Route::post('admin/login', [
          'as' => '',
          'uses' => 'LoginController@login'
        ]);
        Route::post('admin/logout', [
          'as' => 'admin.logout',
          'uses' => 'LoginController@logout'
        ]);

        // Password Reset Routes...
        Route::get('admin/password/reset', [
          'as' => 'admin.password.request',
          'uses' => 'ForgotPasswordController@showLinkRequestForm'
        ]);
        Route::post('admin/password/email', [
          'as' => 'admin.password.email',
          'uses' => 'ForgotPasswordController@sendResetLinkEmail'
        ]);
        Route::get('admin/password/reset/{token}', [
          'as' => 'admin.password.reset',
          'uses' => 'ResetPasswordController@showResetForm'
        ]);
        Route::post('admin/password/reset', [
          'as' => 'admin.password.update',
          'uses' => 'ResetPasswordController@reset'
        ]);

      // Verify Routes
          /*

            Identify all possible routes by tracing how the front-end work

            In authenticated page/home(1st route::GET, HomeController@index, view('index')),
            Redirect to page verify notice if email not verified(2nd route::GET, VericationController@show), view('verify')),
            Send email automatic if from registration, manual if not(3rd route::GET, VerificationController@send/resend),
            When email button is clicked, compare token from email to current user(4th route::GET, VerficationController@verify)

          */ 
          //automatic send email after registered
          Route::get('admin/email/verify','VerificationController@show')->name('admin.verification.notice');
          //resend
          Route::get('admin/email/resend', 'VerificationController@resend')->name('admin.verification.resend');
          //To check if the email token is correct from the user's email
          Route::get('admin/email/verify/{id}', 'VerificationController@verify')->name('admin.verification.verify');
          
      });
    
  /*-------------------------------------------------------------------*/
    //admin/authenticated
    Route::group(['namespace' => 'Authenticated'],function(){
        
        //home
          Route::get('admin/home','HomeController@index')->name('admin.home');
          Route::get('editor/home','EditorController@index')->name('editor.home');

              //Post routes 
              Route::group(['namespace' => 'Post'],function(){

                Route::resource('admin/post','PostController')->names([
                  'index'   => 'admin.post.index',
                  'create'  => 'admin.post.create',
                  'store'   => 'admin.post.store',
                  'edit'    => 'admin.post.edit',
                  'update'  => 'admin.post.update',
                  'destroy' => 'admin.post.destroy',
                ]);
               
                //Comment
                Route::resource('admin/comment','Comment\CommentController')->names([
                  'index'   => 'admin.comment.index',
                  'create'  => 'admin.comment.create',
                  'store'   => 'admin.comment.store',
                  'edit'    => 'admin.comment.edit',
                  'update'  => 'admin.comment.update',
                  'destroy' => 'admin.comment.destroy',
                ]);

              //Category routes
                Route::resource('admin/category','Comment\Category\CategoryController')->names([
                  'index'   => 'admin.category.index',
                  'create'  => 'admin.category.create',
                  'store'   => 'admin.category.store',
                  'edit'    => 'admin.category.edit',
                  'update'  => 'admin.category.update',
                  'destroy' => 'admin.category.destroy',
                ]);

              //Tag routes
                Route::resource('admin/tag','Comment\Tag\TagController')->names([
                  'index'   => 'admin.tag.index',
                  'create'  => 'admin.tag.create',
                  'store'   => 'admin.tag.store',
                  'edit'    => 'admin.tag.edit',
                  'update'  => 'admin.tag.update',
                  'destroy' => 'admin.tag.destroy',
                ]);
                
               });//end of post

        //User routes
          Route::resource('admin/user','User\UserController')->names([
            'index'   => 'admin.user.index',
            'create'  => 'admin.user.create',
            'store'   => 'admin.user.store',
            'edit'    => 'admin.user.edit',
            'update'  => 'admin.user.update',
            'destroy' => 'admin.user.destroy',
          ]);
      
    });//end of authenticated    

});//end of admin


// Route::get('authentication',function(Request $request){

// //use Auth::login() to Manually log an existing user in to your application
//  $user = User::find(1);
//  Auth::login($user, true); 

// /*
// Security
//   Authentication
//   API Authentication
//   Authorization
//   Email Verification
//   Encryption
//   Hashing
//   Password Reset*/


// /*
// Introduction
//     Database Considerations
// Authentication Quickstart
//     Routing
//     Views
//     Authenticating
//     Retrieving The Authenticated User
//     Protecting Routes
//     Login Throttling
// Manually Authenticating Users
//     Remembering Users
//     Other Authentication Methods
// HTTP Basic Authentication
//     Stateless HTTP Basic Authentication
// Logging Out
//     Invalidating Sessions On Other Devices
// Social Authentication
// Adding Custom Guards
//     Closure Request Guards
// Adding Custom User Providers
//     The User Provider Contract
//     The Authenticatable Contract
// Events



// --------------
// AUTHENTICATION
// --------------

//   By default, Laravel includes an "App\User" Eloquent model in your app directory.

//   It is named "Eloquent," simply because it allows you to work with your database objects and relationships using an eloquent and expressive syntax.

//   When building the database schema for the App\User model, make sure the password column is at least 60 characters in length. Maintaining the default string column length of 255 characters would be a good choice.
  
//   -------------------------
//   Authentication Quickstart

//   Laravel ships with several pre-built authentication controllers, which are located in the  App\Http\Controllers\Auth namespace.
  


//   Routing

//   If your application doesn’t need registration, you may disable it by removing the newly created RegisterController and modifying your route declaration:  Auth::routes(['register' => false]);
  


//   Authenticating

//   ------------------
//   Path Customization

//   When a user is "successfully authenticated", they will be redirected to the /home URI. 
//   You can customize the post-authentication redirect location by defining a 'redirectTo' property on the  LoginController, RegisterController, ResetPasswordController, and  VerificationController 

//   If the redirect path needs custom generation logic you may define a redirectTo METHOD instead of a redirectTo PROPERTY. Remove this property, and add a method with equal name.
 
//   The redirectTo method will take precedence over the redirectTo property. This allows us to define logic to handle users with different role to different paths.

//   public function redirectTo(){
    
//     // User role
//     $role = Auth::user()->role->name; 
    
//     // Check user role
//     switch ($role) {
//         case 'Manager':
//                 return '/dashboard';
//             break;
//         case 'Employee':
//                 return '/projects';
//             break; 
//         default:
//                 return '/login'; 
//             break;
//     }
//   }  

//   Next, you should modify the RedirectIfAuthenticated middleware's handle method. This execute when the user is already authenticated and wants to access elsewhere like login, register etc,.
  
//   ----------------------
//   Username Customization
  
//   By default, Laravel uses the email field for authentication. If you would like to customize this, you may define a username method on your LoginController:

//   public function username()
//   {
//      return 'username';
//   }

//   -------------------
//   Guard Customization
  
//   You may also customize the "guard" that is used to authenticate and register users. To get started, define a guard method on your LoginController, RegisterController, and  ResetPasswordController. The method should return a guard instance:

//   use Illuminate\Support\Facades\Auth;

//   protected function guard()
//   {
//    return Auth::guard('guard-name');
//   }



//   Retrieving The Authenticated User

//   You may access the authenticated user via the Auth facade:
//   use Illuminate\Support\Facades\Auth;
//   Note: Auth will use the default guard(web) if no guard is specified
  
//   ---------------------------------------
//   // Get the currently authenticated user...*/
//   $getUser = Auth::user();

//   /*
//   --------------------------------------------
//   // Get the currently authenticated user's ID..*/
//   $getId = Auth::id();

//   /* 
//   Alternatively, once a user is authenticated, you may access the authenticated user via an  Illuminate\Http\Request instance.

//   public function update(Request $request)
//   {*/
//   $getUserFromRequest = $request->user(); //to get admin guard use Auth
//   /*}
  
//   ------------------------------------------------
//   Determining If The Current User Is Authenticated*/
//   $checkUser = '';

//   if (Auth::check()) {
//       $checkUser = 'The user is authenticated.';
//   }

  
//   Protecting Routes

//   -------------------------
//   $this->middleware('auth');

//   ---------------------------------
//   Redirecting Unauthenticated Users
//   Check authenticate middleware

//   ------------------
//   Specifying A Guard
//   When attaching the auth/guest middleware to a route, you may also specify which guard should be used to authenticate the user. 
  
//   $this->middleware('auth:api');



//   Login Throttling

//   If you are using Laravel's built-in LoginController class, the  Illuminate\Foundation\Auth\ThrottlesLogins trait will already be included in your controller. By default, the user will not be able to login for one minute if they fail to provide the correct 




  
//   -----------------------------
//   Manually Authenticating Users
//   ----------------------------- 

//   In your login controller:
//   public function authenticate(Request $request)
//   {
//       $credentials = $request->only('email', 'password');

//       if (Auth::attempt($credentials)) {   //or Auth::guard($guard)->attempt()
//           // Authentication passed...
//           return redirect()->intended('dashboard');
//       }
//   }
//   The attempt method accepts an array of key / value pairs as its first argument. The values in the array will be used to FIND the USER in your database table. So, in the example above, the user will be retrieved by the value of the email column. If the user is found, the hashed password stored in the database will be compared with the password value passed to the method via the array. You should NOT HASH the PASSWORD specified as the password value, since the framework will AUTOMICATICALLY hash the value before comparing it to the hashed password in the database. If the two hashed passwords match an authenticated session will be started for the user.

//   ----------------------------------
//   Accessing Specific Guard Instances
  
//   You may specify which guard instance you would like to utilize using the guard method on the  Auth facade.
//   if (Auth::guard('admin')->attempt($credentials)) {
//     //
//   }


//   Remembering Users
  
//   If you would like to provide "remember me" functionality in your application, you may pass a boolean value as the second argument to the attempt method, which will keep the user authenticated indefinitely, or until they manually logout. Your users table must include the string remember_token column, which will be used to store the "remember me" token.
//   $credentials = $request->only('email', 'password');

//   public function authenticate(Request $request)
//     {
//         $credentials = $request->only('email', 'password');
//         if (Auth::attempt($credentials, $remember)) {
//             // The user is being remembered...
//         }
//     }

//     if you are "remembering" users, you may use the viaRemember method to determine if the user was authenticated using the "remember me" cookie:

//     if (Auth::viaRemember()) {
//         //
//     }



//   Other Authentication Methods

//   ---------------------------- 
//   Authenticate A User Instance

//   If you need to log an existing user instance into your application, you may call the login method with the user instance. The given object MUST be an implementation of the  Illuminate\Contracts\Auth\Authenticatable a contract. The App\User model included with Laravel already implements this interface:

//   Auth::login($user);

//   // Login and "remember" the given user...
//   Auth::login($user, true);
     
//   -------------------------   
//   // Login and "remember" the given user...
//   //Auth::loginUsingId(2, true);   

//   ------------
//   Logging Out
//   ------------

//   --------------------------------------
//   Invalidating Sessions On Other Devices 

//   Laravel also provides a mechanism for invalidating and "logging out" a user's sessions that are active on other devices without invalidating the session on their current device. Before getting started, you should make sure that the Illuminate\Session\Middleware\AuthenticateSession middleware is present and un-commented in your app/Http/Kernel.php class' web middleware group:
  
//   Then, you may use the logoutOtherDevices method on the Auth facade. This method requires the user to provide their current password, which your application should accept through an input form:

//   use Illuminate\Support\Facades\Auth;
//   Auth::logoutOtherDevices($password); 


//   -----------
//   Logging Out
//   Auth::logout(); //only for user
   

//   -------------------- 
//   Adding Custom Guards
//   -------------------- 
//   ...


//   -------------
//   AUTHORIZATION
//   -------------

//   -------------  
//   Writing Gates

//   Gates are Closures that determine if a user is authorized to perform a given action and are typically defined in the App\Providers\AuthServiceProvider class using the Gate facade. 

//   public function boot()
//   {
//     $this->registerPolicies();

//     Gate::define('update-post', function ($user, $post) {
//         return $user->id == $post->user_id;
//     });

//     //Gates may also be defined using a Class@method style callback string, like controllers:
    
//     //Gate::define('update-post', 'App\Policies\PostPolicy@update');
  
//   }
 
//   -------------------
//   Authorizing Actions

//   $authorization = '';
//   $user = Auth::user(); 
//         //assuming USER ID is 1 and post->user matches the current user
//   $post = 1;

//   if (Gate::allows('authentication',$user,$post)) {
//     $authorization = 'I am authorized to do something';
//   };
  
// /*same as
//   if (Gate::forUser($user)->allows('update-post', $post)) {
//       // The user can update the post...
//   }

//   You may also define multiple Gate abilities at once using the resource method:
//   $this->registerPolicies();

//   Gate::define('update-post', 'App\Policies\PostPolicy@update');
//   Gate::resource('posts', 'App\Policies\PostPolicy');

//   if (Gate::denies('update-post', $post)) {
//       // The current user can't update the post...
//   }
//   If you would like to determine if a particular user is authorized to perform an action, you may use the forUser method on the Gate facade(which is similar implementation from above):

//   if (Gate::forUser($user)->denies('update-post', $post)) {
//       // The user can't update the post...
//   }

//   ------------------------
//   Intercepting Gate Checks

//   Sometimes, you may wish to grant ALL abilities to a specific user. You may use the before method to define a callback that is run before all other authorization checks:

//   Gate::before(function ($user, $ability) {
//       if ($user->isSuperAdmin()) {
//           return true;
//       }
//   });

//   You may use the after method*/

//   Auth::guard('admin')->loginUsingId(2);
//   $user = Auth::guard('admin')->user();
//   $post = 1;

//   $authorizedAdmin = '';

//   if (Gate::allows('authentication',$user,$post)) {
//     $authorizedAdmin = 'I am authorized no matter what because i am an authorized Administrator';
//   };



// /*-----------------
//   Creating Policies
//   -----------------


//   -------------------
//   Generating Policies
//   php artisan make:policy PostPolicy

//   The make:policy command will generate an empty policy class. If you would like to generate a class with the basic "CRUD" policy methods already included in the class, you may specify a  --model when executing the command:
//   php artisan make:policy PostPolicy --model=Post

//   Registering Policies
//   Once the policy exists, it needs to be registered in the AuthServiceProvider
  
//   */

   
// });