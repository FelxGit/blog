
<!-- note: html does not accept routing as backward slash \-->
@extends('open.layouts.app')

@section('title','About')

@section('brand-name','Fels Blog')
<!-- header image -->
@section('bg-img', asset('open/header-files/themes/clean-blog/img/About-bg.jpg'))

@section('header-title','About Me')

@section('sub-heading','This is what I do.')

@section('main-content')

  <!-- Main Content -->
  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-10 mx-auto">
        <blockquote>
         <p>This is a free template design that's broke-apart, modified, server-implemented and assembled in my style of work. I had so much fun welding the application while learning along the way. I hope there will be more to come, even more learning outcomes that I ever had. Let's work together. :)</p>
               <footer>~Developer</footer>
        </blockquote>
      </div>
    </div>
  </div>

  <hr>


@endsection