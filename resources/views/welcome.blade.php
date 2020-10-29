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
        @include('layouts.css')

    </head>

    <body>
        <!-- offers  -->
        @include('layouts.offers')

        <!-- nav  -->
        @include('layouts.nav')

        <!-- welcome  -->
        @include('layouts.welcom_pictuers')

        <!-- Start Products  -->
        @yield('content')

        <!-- Footer  -->
            @include('layouts.footer') 

        <!-- ALL JS FILES -->
            @include('layouts.js')
            @yield('js')
        
    </body>

</html>