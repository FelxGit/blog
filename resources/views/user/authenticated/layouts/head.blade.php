  
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="This is the project from followng Sarthakk tutorials">
  <meta name="author" content="Fel Reind Entica">
  <meta name="csrf-token" content="{{ csrf_token() }}">


  <title>@yield('title')</title>
  
<!-- Global -->

<!-- Clean Blog Files-->

  <!-- jQuery 3 -->
  <script src="{{ asset('user/authenticated/header-files/libraries/jquery/jquery.min.js') }}"></script>

<!-- Bootstrap core CSS -->
  <link href="{{ asset('user/authenticated/header-files/themes/clean-blog/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

  <script defer src="{{ asset('user/authenticated/header-files/themes/clean-blog/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<!-- Custom fonts for this template -->

  <!-- Font Awesome - icons -->
  <link rel="stylesheet" type="text/css" href="{{ asset('admin/header-files/icons/font-awesome/font-awesome.min.css') }}">
 <!--  <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
 -->
  <link href='https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic' rel='stylesheet' type='text/css'>

  <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>


<!-- Custom styles for this template -->
  <link href="{{ asset('user/authenticated/header-files/themes/clean-blog/css/clean-blog.min.css') }}" rel="stylesheet">

<!-- Custom scripts for this template -->
  <script defer src="{{ asset('user/authenticated/header-files/themes/clean-blog/js/clean-blog.min.js') }}"></script>


@if(Request::is('home')) 
  <link rel="stylesheet" type="text/css" href="{{ asset('user/authenticated/header-files/custom/home/home.css') }}">
@endif

@if(Request::is('post/*'))

  <script defer type="text/javascript" src="{{ asset('user/authenticated/header-files/ajax-request/comment/comment.js ') }}"></script>

  <script defer type="text/javascript" src="{{ asset('user/authenticated/header-files/ajax-request/comment/like/like.js') }}"></script>

  <script defer type="text/javascript" src="{{ asset('user/authenticated/header-files/custom/post/form/prevent-btn-submit-x-times.js') }}"></script>

  <link href="{{ asset('user/authenticated/header-files/custom/post/form/input-invalid.css') }}"></script>

  <script type="text/javascript" src="{{ asset('user/authenticated/header-files/custom/post/comment/notification-flash.js') }}"></script>

@endif

<!-- Custom styles for profile-->
@if(Request::is('profile'))

<!-- Profile Files -->

  <link rel="stylesheet" type="text/css" href="{{ asset('user/authenticated/header-files/custom/profile/profile.css') }}">

  <link rel="stylesheet" type="text/css" href="{{ asset('user/authenticated/header-files/custom/profile/font-size.css') }}">

  <script defer type="text/javascript" src="{{ asset('user/authenticated/header-files/custom/profile/form/prevent-btn-submit-x-times.js') }}"></script>

  <script defer type="text/javascript" src="{{ asset('user/authenticated/header-files/custom/profile/form/toggleable-form.js') }}"></script>

  <link href="{{ asset('user/authenticated/header-files/custom/post/form/input-invalid.css') }}">

@endif  
  
@if(Request::is('post/create') || Request::is('post/*/edit'))

  <!-- CK Editor -->
  <script defer src="{{ asset('user/authenticated/header-files/plugins/text-editors/ckeditor/ckeditor.js') }}"></script>

  <script defer src="{{ asset('user/authenticated/header-files/plugins/text-editors/ckeditor/start.js') }}"></script>

  <!-- Select 2 - Multiple Select --->
  <link rel="stylesheet" href="{{ asset('user/authenticated/header-files/plugins/multi-select/select2/dist/css/select2.min.css') }}">

  <script defer src="{{ asset('user/authenticated/header-files/plugins/multi-select/select2/dist/js/select2.full.min.js') }}"></script>
  
  <script defer src="{{ asset('user/authenticated/header-files/plugins/multi-select/select2/start/initialize.js') }}"></script>
  
  <script defer type="text/javascript" src="{{ asset('user/authenticated/header-files/custom/post/form/prevent-btn-submit-x-times.js') }}"></script>  

  <link href="{{ asset('user/authenticated/header-files/custom/post/form/input-invalid.css') }}"></script>

@endif

@if(Request::is('home') || Request::is('post/*'))
<link rel="stylesheet" type="text/css" href="{{ asset('user/authenticated/header-files/custom/post/create_post_dots.css') }}">
@endif