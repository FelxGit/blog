
  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
    <div class="container">
      <a class="navbar-brand" href="{{ route('home') }}">@yield('brand-name')</a>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        Menu
        <i class="fas fa-bars"></i>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="{{ route('user.home') }}">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('about') }}">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('contact') }}">Contact</a>
          </li>

           <!-- If guest -->
          @guest
          <li class="nav-item">
              <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
         </li>
          @if (Route::has('register'))
          <li class="nav-item">
              <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
          </li>
          @endif

          <!-- if user is authenticated -->
          @else
          <li class="nav-item dropdown">
              <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                  {{ Auth::user()->name }} <span class="caret"></span>
              </a>

              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                  @if(!Request::is('profile'))
                  <a class="dropdown-item" href="{{ route('user.profile') }}">
                      {{ __('Profile') }}
                  </a>
                  @endif
                  <a class="dropdown-item" href="{{ route('logout') }}"
                     onclick="event.preventDefault();
                                   document.getElementById('logout-form').submit();">
                      {{ __('Logout') }}
                  </a>

                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                      @csrf
                  </form>
              </div>
          </li>
          <li class="nav-item dropdown">
            <a id="noti_dropdown" class="nav-link fa fa-bell-o" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                 
                 <span class="badge">{{ !empty($notifications)? count($notifications) : ''}}</span> 
                </a>

                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="noti_dropdown">
                 
                 <!-- check notification if have any -->
                 @if(!empty($notifications))

                 <!-- loop all noti -->
                   @forelse($notifications as $noti)

                   
                   <!-- get key instance of post id -->
                   @if(!empty($user_post = DB::table('posts')->where('id', $noti->post_id)->first()))
                  
                    <!-- get the URL route then append the #HASH -->
                     <a class="dropdown-item" href="@if(!empty($url = URL::route('user.post.show',['post' => $user_post->slug]) . '#'.$noti->comment_id ))

                      {{ $url }}

                      @endif">                 
                         {!! $noti->message !!}
                     </a>

                    @endif

                   @empty
                   <a class="dropdown-item" href="">                 
                     <span class="text-info">You have 0 notifications.</span>
                   </a>
                   @endforelse

                 @endif
<!-- 
                 <a class="dropdown-item" href="{{ route('user.post.create') }}">
                   Create Post
                  </a>
-->             </div>
          </li>

          <!-- for home -->
          @if(Request::is('home'))
            <li class="nav-item dropdown">
                <a id="dotsDropdown" class="nav-link mydots" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                  <div class="dots"></div>
                </a>

                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dotsDropdown">
                 <a class="dropdown-item" href="{{ route('user.post.create') }}">
                   Create Post
                  </a>
                </div>
            </li>
          @endif

  
          <!-- for post show ONLY-->
          @if(Request::is('post/*') && !Request::is('post/create'))

            <li class="nav-item dropdown">
                <a id="dotsDropdown" class="nav-link dropdown-toggle mydots" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                  <div class="dots"></div>
                </a>

                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dotsDropdown">
                  <a class="dropdown-item" href="{{ route('user.post.create') }}">
                   Create Post
                  </a>  
                  @if(!empty($post->slug))
                  
                  @can('edit',$post)
                  <a class="dropdown-item" href="{{ route('user.post.edit',['post' => $post->slug]) }}">
                   Edit Post
                  </a>
                  @endcan

                  @can('delete',$post)

                    <a id="confirm_delete" class="dropdown-item dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>Delete<span class="caret"></span>
                                </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="confirm_delete">
                        <a class="dropdown-item" href="{{ route('user.post.destroy',['post' => $post->slug]) }}"
                           onclick="event.preventDefault();
                                         document.getElementById('delete-form').submit();">
                            {{ __('Confirm') }}
                        </a>

                        <form id="delete-form" action="{{ route('user.post.destroy',['post' => $post->slug]) }}" method="POST" style="display: none;">
                          @method('DELETE')
                            @csrf
                        </form>
                    </div>
                  @endcan


                @endif
            </li>

          @endif
          @endguest

        </ul>
      </div>
    </div>
  </nav>
    <!-- Page Header -->
  <header class="masthead" style="background-image: url(@yield('bg-img'))">
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <div class="site-heading">
            <h1>@yield('header-title')</h1>
            <span class="subheading">@yield('sub-heading')</span>
          </div>
        </div>
      </div>
    </div>
  </header>
