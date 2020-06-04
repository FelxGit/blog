
<!-- note: html does not accept routing as backward slash \-->
@extends('user.authenticated.layouts.app')

@section('title','Blog')

@section('brand-name','Fels Blog')
<!-- header image -->
@section('bg-img', asset('user/authenticated/header-files/themes/clean-blog/img/post-bg.jpg'))

@section('header-title','Blog')

@section('sub-heading','Have something on mind?')

@section('main-content')
<!-- Main Content -->
  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-10 mx-auto">
        
        @forelse($posts as $post)
        <div class="post-preview">
          <a href="{!! route('user.post.show',['post' => $post->slug]) !!}">
            <h2 class="post-title">
              {{ $post->title }}
            </h2>
            <h3 class="post-subtitle">
              {{ $post->subtitle }}
            </h3>
          </a>
          <p class="post-meta">Posted by 
            @if(!empty($user = DB::table('users')->where('id',$post->user_id)->first()))
              {{ $user->name }}
            @endif
            on {{ $post->created_at->diffForHumans() }}</p>
        </div>
        <hr>
        @empty
        <strong>No Data</strong>
        @endforelse
        <!-- Pager -->
        <div class="clearfix pull-right">
          {{ $posts->links() }}
        </div>
      </div>
    </div>
  </div>
@endsection
