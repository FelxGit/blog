@extends('user.authenticated.layouts.app')

@section('title','Blog')

@section('brand-name','Fels Blog')
<!-- header image -->
@section('bg-img', asset('user/authenticated/header-files/themes/clean-blog/img/post-bg.jpg'))

@section('header-title','Profile')

@section('sub-heading','Let us know you.')

@section('main-content')

<div class="profile" class="container">

  <!-- check session -->
  @if(!empty(session('updated')))
    <div class="alert alert-success">
      {{ session('updated') }}
    </div>
  @endif

  <div class="display">
    <div class="user">
      <div class="image">
        <figure>
          <!-- 
          Note: By default, storage/app/public directory is not accessible from the outside web. So you have to create a symbolic link between that directory and your public one: from storage/app/public -> public/storage -->
        

          @if(!empty($active_image))
        
            <img src="{{ asset('storage/user/authenticated/files/'.Auth::user()->email.'/images/'.$active_image->full_name) }}"
              alt="profile-image"> 
          @else
            <img src="{{ asset('storage/open/files/images/profile.png') }}"
                alt="default-image-flower">
          @endif

          @if(!empty($profile))  
          <figcaption>

            {{ $profile->name }} | {{ $profile->gender }} | {{ $profile->email }} 

          </figcaption>
          @endif

        </figure>
      </div>
      <div class="update_pp">
        <div class="container">
                <!-- Trigger the modal with a button -->
        <a href="#" data-toggle="modal" data-target="#myModal">Update Picture</a>

        <!-- Modal -->
        <div id="myModal" class="modal fade" role="dialog">
          <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">Gallery</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>
              <div class="modal-body">

                  <!-- carousel-->
                  <div id="demo" class="carousel" data-ride="carousel">

                    <!-- Indicators -->
                    <ul class="carousel-indicators">
                      <li data-target="#demo" data-slide-to="0" class="active"></li>
                      <li data-target="#demo" data-slide-to="1"></li>
                      <li data-target="#demo" data-slide-to="2"></li>
                    </ul>

                    <!-- The slideshow -->
                    <div class="carousel-inner">
                    
                    @if(!$active_image && !$non_active_images)
                      <i>update your profile to add picture..</i>
                    @endif

                      @if(!empty($active_image))
                      <div class="carousel-item active">
                        <img src="{{ asset('storage/user/authenticated/files/'.Auth::user()->email.'/images/'.$active_image->full_name) }}" alt="image">
                      </div>
                      @endif

                      @if(!empty($non_active_images))
                      
                      @foreach($non_active_images as $image)

                         <div class="carousel-item">
                             <form id="{{ $image->id }}" method="POST" action="{{ route('user.profile.update_pp',['img' => $image->full_name]) }}">
                                 @method('PUT')
                                 @csrf
                             </form> 
                             
                            <a href="{{ route('user.profile.update_pp',['img' => $image->full_name]) }}" onclick="event.preventDefault();
                                   document.getElementById({{ $image->id }}).submit();">Set as profile picture</a>
                            
                            <br/> 
                          <center>
                            <img src="{{ asset('storage/user/authenticated/files/'.Auth::user()->email.'/images/'.$image->full_name) }}" alt="image">
                          </center>
                          </div>

                      @endforeach

                      @endif
                    </div>

                    <!-- Left and right controls -->
                    <a class="carousel-control-prev" href="#demo" data-slide="prev">
                      <span class="carousel-control-prev-icon"></span>
                    </a>
                    <a class="carousel-control-next" href="#demo" data-slide="next">
                      <span class="carousel-control-next-icon"></span>
                    </a>

                  </div>
                <div class="row">
                
                </div>
              </div>

              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  <div class="container">
      <div class="intro">
        <h3><span class="fa fa-globe color-black" id="intro-icon"></span> Intro</h3>
        <p>{{ !empty($profile) ? $profile->intro : '' }}</p>
      </div>
      <div class="row text-center">
          <div class="col-md-4" style="overflow: hidden;">
            @if(!empty($profile))
            <strong>Current City</strong>
            <p>{{ !empty($profile->current_city) ? $profile->current_city : '' }}</p>
          </div>
          <div class="col-md-4" style="overflow: hidden;">
            <strong>Hobby</strong>
            <p>{{ !empty($profile->hobby) ? $profile->hobby : '' }}</p>
          </div>
          <div class="col-md-4" style="overflow: hidden;">
            <strong>Hometown</strong>
            <p>{{ !empty($profile->hometown) ? $profile->hometown : '' }}</p>
          </div>
          @endif
      </div>
    </div>
  </div>
  
  <div class="profile-form-toggle">
    <p>Update your profile..</p>
    <p>
        <a class="btn btn-primary">
          Hide Form
        </a>
    </p>
  </div>
 
  <div class="update" class="container">
  @if(empty($profile))
  <form action="{{ route('user.profile.store') }}" method="POST" enctype="multipart/form-data" role="form">
    @method('POST')
    @elseif(!empty($profile))

  <form action="{{ route('user.profile.update',['profile' => Auth::user()->profile->name]) }}" method="POST" enctype="multipart/form-data" role="form">
    @method('PUT')
  @endif
  @csrf
  <div class="box">
      <div class="box-body">
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              @if ($errors->any())
                  <div class="alert alert-danger">
                      <ul>
                          @foreach ($errors->all() as $error)
                              <li>{{ $error }}</li>
                          @endforeach
                      </ul>
                  </div>
              @endif

            </div>
            <div class="form-group">
              <label for="intro">Intro</label>
              <textarea id="editor1" class="textarea form-control {{ $errors->has('intro') ? 'is-invalid' : '' }}"  name="intro" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">@if(!empty(old('intro'))){{ old('intro') }}@elseif(!empty($profile)){{ $profile->intro }}@endif</textarea>            
            </div>
            <div class="form-group">
              <label for="hobby">Hobby</label>
              @if ($errors->has('hobby'))
                    <span class="invalid-feedback" role="alert">
                        <strong><br/>{{ $errors->first('hobby') }}</strong>
                    </span>
              @endif
              <textarea id="editor1" class="textarea {{ $errors->has('hobby') ? 'is-invalid' : '' }}"  name="hobby" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">@if(!empty(old('hobby'))){{ old('hobby') }}@elseif(!empty($profile)){{ $profile->hobby }}@endif</textarea>            
            </div>
          </div>
          

          <div class="col-md-6">

            <div class="form-group">
              <div data-role="main" class="ui-content">
                <fieldset data-role="controlgroup">
                <p>Choose your gender: </p>
                  <label for="male">Male</label>
                  <input type="radio" name="gender" id="male" value="male" @if(!empty(old('gender')=='male')) checked
                  @elseif(!empty($profile))
                    @if(!empty($profile->gender == 'male'))

                      checked

                    @endif
                  @endif>
                  <label for="female">Female</label>
                  <input type="radio" name="gender" id="female" value="female" @if(!empty(old('gender')=='female')) checked
                  @elseif(!empty($profile))
                   @if(!empty($profile->gender == 'female'))
                    
                      checked

                    @endif
                  @endif>
              </div>
            </div>

            <div class="form-group">
                <label for="current_city">Current City</label>
                <input type="text" class="form-control{{ $errors->has('current_city') ? ' is-invalid' : '' }}" id="current_city" name="current_city" 
                value="@if(!empty(old('current_city'))){{ old('current_city') }}@elseif(!empty($profile)){{ $profile->current_city }}@endif" placeholder="current_city..">
            </div>

            <div class="form-group">
                <label for="hometown">Hometown</label>
                @if ($errors->has('hometown'))
                      <span class="invalid-feedback" role="alert">
                          <strong><br/>{{ $errors->first('hometown') }}</strong>
                      </span>
                @endif
                <input type="text" class="form-control{{ $errors->has('hometown') ? ' is-invalid' : '' }}" id="hometown" name="hometown" 
                value="@if(!empty(old('hometown'))){{ old('hometown') }}@elseif(!empty($profile)){{ $profile->hometown }}@endif" placeholder="hometown..">
            </div>

            <div class="form-group">
                <label for="hometown">Profile picture?</label>
                @if ($errors->has('image'))
                      <span class="invalid-feedback" role="alert">
                          <strong><br/>{{ $errors->first('image') }}</strong>
                      </span>
                @endif
                <input type="file" class="form-control{{ $errors->has('image') ? ' is-invalid' : '' }}" id="image" name="image" placeholder="image..">
            </div>

          </div><!-- end of col -->

            <div class="box-footer">
              <button type="submit" name="submit" class="btn btn-primary">Submit</button>
            </div>

          </div><!-- end of row -->
        </div> <!-- end of box-body-->
     </div><!-- end of box -->
</div>
</form>
</div>
</div>
@endsection 