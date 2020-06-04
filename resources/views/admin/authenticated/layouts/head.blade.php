
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <title>@yield('title')</title>

  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">


<!-- 
Note when implenting inline script(ex.filter) that utilize external script(ex.jquery), then your external script must be at the top to be utilize by the inline js.
Having defered script is nice, best is you make your inline/internal script as external so you can defer-->



<!-- Global Header Files -->

 <!-- jQuery 3 -->
  <script src="{{ asset('user/authenticated/header-files/libraries/jquery/jquery.min.js') }}"></script>

  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{ asset('admin/header-files/frameworks/bootstrap/bootstrap.min.css') }}">
  <script defer src="{{ asset('admin/header-files/frameworks/bootstrap/bootstrap.min.js') }}"></script>

  <!-- AdminLTE - Theme -->
  <link rel="stylesheet" href="{{ asset('admin/header-files/themes/adminLTE/AdminLTE.min.css') }}">
  <script defer src="{{ asset('admin/header-files/themes/adminLTE/adminlte.min.js') }}"></script>
  
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="{{ asset('admin/header-files/skins/adminLTE/_all-skins.min.css') }}">

  <!-- Font Awesome - icons -->
  <link rel="stylesheet" type="text/css" href="{{ asset('admin/header-files/icons/font-awesome/font-awesome.min.css') }}">



<!-- Local Header Files-->

@if(Request::is('admin/*/create') || Request::is('admin/*/edit'))
  <!-- Bootstrap WYSIHTML5 - Text Editor -->
  
  <!-- CK Editor -->
  <script defer src="{{ asset('admin/header-files/plugins/text-editors/ckeditor/ckeditor.js') }}"></script>

  <script defer src="{{ asset('admin/header-files/plugins/text-editors/ckeditor/start.js') }}"></script>


  <!-- Select 2 - Multiple Select --->
  <link rel="stylesheet" href="{{ asset('admin/header-files/plugins/multi-select/select2/dist/css/select2.min.css') }}">

  <script defer src="{{ asset('admin/header-files/plugins/multi-select/select2/dist/js/select2.full.min.js') }}"></script>
  
  <script defer src="{{ asset('admin/header-files/plugins/multi-select/select2/start/initialize.js') }}"></script>


  <!-- Custom CSS - Form -->
  <link rel="stylesheet" href="{{ asset('admin/header-files/custom/form/input-invalid.css') }}">
  
  <script defer type="text/javascript" src="{{ asset('admin/header-files/custom/form/prevent-btn-submit-x-times.js') }}"></script>  


  @endif


  @if(Request::is('admin/*') && !Request::is('*/*/*'))
  
  <!-- Custom CSS - Table -->
  <script defer type="text/javascript" src="{{ asset('admin/header-files/frameworks/bootstrap/filter/filter-table.js') }}"></script>

  <script defer type="text/javascript" src="{{ asset('admin/header-files/frameworks/bootstrap/tooltip/tooltip.js') }}"></script>


<!-- Table-->
    <!--font-->
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
  
    <!--icons-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  
    <!--custom css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/header-files/custom/table/table-style.css') }}">
  @endif

</style>





