

<!DOCTYPE html>
<html style="min-width: 1200px">
<head>
	
	@include('admin/authenticated/layouts/head')

</head>
<body class="hold-transition skin-blue sidebar-mini">

      @include('admin/authenticated/layouts/header')

      @include('admin/authenticated/layouts/sidebar')    
      
      @section('main-content')
        @show     
      
      @include('admin/authenticated/layouts/footer')

</body>
</html>
  