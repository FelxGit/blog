@extends('user.authenticated.layouts.app')

@section('title','Blog')

@section('brand-name','Fels Blog')
<!-- header image -->
@section('bg-img', asset('user/header-files/global/themes/clean-blog/img/post-bg.jpg'))

@section('header-title',$post->title)

@section('sub-heading',$post->subtitle)

@section('main-content')

<!-- Main Content -->
  <div class ="container">
    
    <div class="row"> 

      <div class="col-lg-8 col-md-10 mx-auto">

       <div id="post">

        <div class="row">

          <div class="col-lg-6 col-md-6">

            <div id="created" class="pull-left">

              <small class="post-meta">Created at {{ $post->created_at->diffForHumans() }}</small>

            </div>

          </div>

          <div class="col-lg-6 col-md-6">

            <div id="category" class="pull-right">

              @foreach($post->categories as $categories)

                  <small>| {!! $categories->name !!} </small> 

              @endforeach
              
            </div>

          </div>

        </div>

        <div id="body">
        
           <br/>{{ $post->body }}
       
        </div>

        <div id="tags" class="text-right">

              @foreach($post->tags as $tags)

                  <small class="text-primary"> #{!! $tags->name !!} </small> 

              @endforeach

        </div>    

        <hr>

        <div id="comments">
                  
        </div>


            <!-- Pager -->
            <!--<div class="clearfix">
              <a class="btn btn-primary float-right" href="#">Older Posts &rarr;</a>
            </div>-->
          </div>

  
      </div>
    </div>


    <div id="add-comment" class="text-right">
       <a class="text-primary"><u>Add Comment</u></a>
    </div>

<script type="text/javascript">
  $(document).ready(function(){
    
    $('#comment').hide();
    $('#reg-link').hide();

    $("#add-comment").click(function(){
          
            $('#comment').toggle(500);
          
          @guest
            $('#reg-link').toggle(500);
          @endguest
    });

  });

</script>    
            @guest
              <div id="reg-link">
                  <a  class="text-primary" href="{{ route('register') }}">Please login</a> to comment.
              </div>
            @endguest
        <!-- comments container -->
            <div class="comment_block">

                 <!-- used by #{user} to create a new comment -->
                 <div class="create_new_comment">

                  <!-- current #{user} avatar -->
                  <div class="row">
                  <div class="user_avatar">
                    <img src="https://s3.amazonaws.com/uifaces/faces/twitter/BillSKenney/73.jpg">
                  </div><!-- the input field -->
                  <div class="col-md-* input_comment">
                      
           <!--           @auth     
                      <form id="comment" action="{{ route('admincomment.store',['post_id' => $post->id,
                                                                           '']) }}" method="post">
                          @csrf
                          @method('post')
                          <div class="form-group">
                            <textarea type="text" class="form-control" placeholder="join the conversation.."></textarea>
                          </div>
                          <div class="form-group">
                            <button class="btb btn-primary" type="submit">Submit</button>
                          </div>
                      </form>
                      @endauth 
               -->       
                  </div>
                  </div>

                 </div>


             <!-- new comment -->
             <div class="new_comment">

              <!-- build comment -->
              <ul class="user_comment">

                <!-- current #{user} avatar -->
                <div class="user_avatar">
                  <img src="https://s3.amazonaws.com/uifaces/faces/twitter/dancounsell/73.jpg">
                </div><!-- the comment body --><div class="comment_body">
                  <p>Gastropub cardigan jean shorts, kogi Godard PBR&B lo-fi locavore. Organic chillwave vinyl Neutra. Bushwick Helvetica cred freegan, crucifix Godard craft beer deep v mixtape cornhole Truffaut master cleanse pour-over Odd Future beard. Portland polaroid iPhone.</p>
                </div>

                <!-- comments toolbar -->
                <div class="comment_toolbar">

                  <!-- inc. date and time -->
                  <div class="comment_details">
                    <ul>
                      <li><i class="fa fa-clock-o"></i> 13:94</li>
                      <li><i class="fa fa-calendar"></i> 04/01/2015</li>
                      <li><i class="fa fa-pencil"></i> <span class="user">John Smith</span></li>
                    </ul>
                  </div><!-- inc. share/reply and love --><div class="comment_tools">
                    <ul>
                      <li><i class="fa fa-share-alt"></i></li>
                        <li><i class="fa fa-reply"></i></li>
                      <li><i class="fa fa-heart love"></i></li>
                    </ul>
                  </div>

                </div>
             </div>


  </div>

@endsection