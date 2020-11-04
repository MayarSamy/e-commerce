<!DOCTYPE html>
<html lang="en">
<!-- Basic -->

<head>
    @section('title')
    Welcome
    @endsection
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Site Metas -->
    <title>{{config('app.name')}} | @yield('title')</title>
    @include('layouts.parts.css')

</head>

<body>
    <!-- offers  -->
    @yield('offers')
    <!-- nav  -->
    @include('layouts.parts.nav')

    <!-- welcome  -->
    @include('layouts.parts.welcom_pictuers')

    <!-- Start Products  -->
    @yield('content')

    <!-- Footer  -->
    @include('layouts.parts.footer')

    <!-- ALL JS FILES -->
    @include('layouts.parts.js')
    @yield('js')

</body>

</html>