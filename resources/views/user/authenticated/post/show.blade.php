@extends('user.authenticated.layouts.app')

@section('title','Blog')

@section('brand-name','Fels Blog')
<!-- header image -->
@section('bg-img', asset('user/authenticated/header-files/themes/clean-blog/img/post-bg.jpg'))

@section('header-title','')

@section('sub-heading','Have something on mind?')

@section('main-content')

<!-- Main Content -->
  <div class="container">
    
  
       <div id="post">
            @if(!empty(session('message')=='Update success'))
              <div class="alert alert-success">
                {{ session('message') }}
              </div>
            @elseif(!empty(session('message')=='Update failed'))
              <div class="alert alert-danger">
                {{ session('message') }}
              </div>            
            @endif

            @if(!empty(session('message')=='Create success'))
              <div class="alert alert-success">
                {{ session('message') }}
              </div>
            @elseif(!empty(session('message')=='Create failed'))
              <div class="alert alert-danger">
                {{ session('message') }}
              </div>            
            @endif

            @if(!empty(session('message')=='Delete failed'))
              <div class="alert alert-danger">
                {{ session('message') }}
              </div>            
            @endif
        </div>
        <div class="row">
        
          <div class="col-lg-6 col-md-6">

            <div id="created" class="text-center">

              <small class="post-meta">Created at {!! $post->created_at->diffForHumans() !!}</small>

            </div>

          </div>

          <div class="col-lg-6 col-md-6">

            <div id="category" class="text-center">

              @foreach($post->categories as $categories)

                  <small>| {{ $categories->name }} </small> 

              @endforeach
              
            </div>

          </div>

        </div>

        <div id="body" class="text-center">
        
           <br/>{!! $post->body !!}
       
        </div>

        <div id="tags" class="text-right">

              @foreach($post->tags as $tags)

                  <small class="text-primary"> #{!! $tags->name !!} </small> 

              @endforeach

        </div>    

        <hr>
            <!-- Pager -->
            <!--<div class="clearfix">
              <a class="btn btn-primary float-right" href="#">Older Posts &rarr;</a>
            </div>-->
    </div>

    <div id="comment">
        <div class="col-md-offset-4 col-md-8 mx-auto">
          <script type="text/javascript">
            $(document).ready(function(){
              
              $('#comment-form').hide();
              $('#reg-link').hide();

              @if($errors->any())
                $('#comment-form').show();
              @endif 


              $("#add-comment").click(function(){
                    @auth
                      $('#comment-form').toggle(500);
                    @else
                      $('#reg-link').toggle(500);
                    @endauth
              });

            });

          </script>
          <div class="comment-enable">
            @guest
              <div id="reg-link">
                  <a  class="text-primary" href="{{ route('login') }}">Please login</a> to comment.
              </div>
            @endguest

            <div id="add-comment" class="text-right">
               <a class="text-primary" href="#comment-enable"><u>Add Comment</u></a>
            </div>
          </div> 
          @auth
          @if(!empty($post->id))    
              <!-- Right-aligned -->
              <div class="media" id="comment-form">

                <div class="media-left">
                  <img src="{{ asset('storage/open/files/images/profile.png') }}"  class="media-object" style="width:60px; border-radius: 50%">
                </div>
                <div class="media-body" style="margin-left: 25px">
                    <!-- form action="{{ route('user.comment.store',['post_id' => $post->id]) }}" method="post">
                          @csrf
                          @method('post')

                          <div class="form-group">
                            <input type="text" name="title" class="form-control {{ $errors->has('title') ? ' is-invalid' : '' }}" value="" placeholder="Header..">
                          </div>
                           -->
                          <div class="form-group">
                            <textarea type="text" name="description" id="description" class="form-control {{ $errors->has('description') ? ' is-invalid' : '' }}" placeholder="join the conversation.."></textarea>
                          </div>
                          <div class="form-group" id="submit">
                            <button type="submit" href="#comment-form" id="comment_submit" class="btn btn-primary">Submit
                              <!-- the only reason is to have the btn have its id name. -->
                              <input type="hidden" value="{{ $post->id }}" name="post_id"></button>
                          </div>
                      <!-- </form> -->  
                    
                </div>
              </div>
           @endif  
          @endauth 

              @if(empty($comments))

              <!-- Right-aligned -->
              <div class="media">
                <div class="media-left">
                  <img src="{{ asset('storage/open/files/images/profile.png') }}" class="media-object" style="width:60px;border-radius: 50%">
                </div>

                <div class="media-body">
                  <h4 class="media-heading">John Doe</h4>
                  <strong>Awesome!</strong>
                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                </div>
              </div>
              @else
              @foreach($comments as $comment)
              <!-- Right-aligned -->
              <div id="{{ $comment->id }}" class="media row">
                <div class="col-1 media-middle">
                  <div style="background-color: lightgray;border-radius: 5px">

                  <!-- get user active profile -->
                  @if(!empty($user = DB::table('users')->where('id',$comment->user_id)->first()))
                  <!-- get profile -->
                    @if(!empty($profile = DB::table('profiles')->where('user_id',$user->id)->first()))
                      @if(!empty($file = DB::table('files')->where([['profile_id',$profile->id], ['active',true]])->first()))

                      <img src="{{ asset('storage/user/authenticated/files/'.$user->email.'/images/'.$file->full_name) }}" class="media-object" style="width:45px;border-radius: 50%;border: thin solid white"><br/>
                      @else
                        <img src="{{ asset('storage/open/files/images/profile.png') }}" class="media-object" style="width:45px;border-radius: 50%;border: thin solid white"><br/>
                      @endif
                    @else
                      <img src="{{ asset('storage/open/files/images/profile.png') }}" class="media-object" style="width:45px;border-radius: 50%;border: thin solid white"><br/>
                    @endif  

                  @endif

                  </div>
                  <div style="font-size: calc(5px + 0.5vw)">
                <!-- it seems find() is not applicable for blade  -->
                  @if(!empty($user = DB::table('users')->where('id',$comment->user_id)->first()))
                    {{ $user->email }}
                  @endif
                  </div>
                </div>  
                <!-- it is good to put ids in a loop of displayed data for instance of redirecting to specific elements -->
                <div class="col-11 media-body" style="margin-left: 25px">
                  <p class="media-heading"></p>
                  <p>{{ $comment->description }}<br/>
                  <small>{{ !empty($comment->created_at)? $comment->created_at->diffForHumans() : '' }}
                   <i id="like-load">
                   <i class="fa fa-heart"></i>

                    <!-- get comment likes -->
                    @if(!empty($likes = $comment->likes))
                    {{ count($likes)? count($likes) : ''}} 
                    @endif

                  <!-- show like(if not like) | unlike(if currently liked)-->
                    @if(empty($like = $comment->likes()->where('user_id',Auth::user()->id)->first()))


                    <a href="#media" class="like">Like 
                    <input type="hidden" id="like" value="{{ $comment->id }}"></a>
                    @else
                    <a href="#media" class="unlike">Unlike 
                    <input type="hidden" id="unlike" value="{{ $like->id }}"></a>
                    @endif
                    </i>
                  </small>
                  </p>
                </div>
              </div>
              @endforeach
              @endif

             </div>  
           </div>

@endsection
