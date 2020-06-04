<!DOCTYPE html>
<html lang="en">
<head>
    @include('user/authenticated/layouts/head')
</head>

<body>

    @include('user/authenticated/layouts/header')

    @section('main-content')
        @show
        
    @include('user/authenticated/layouts/footer')

</body>
</html>
