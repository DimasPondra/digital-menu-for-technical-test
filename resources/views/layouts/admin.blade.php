<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        @stack('before-style')
        @include('includes.backend.style')
        @stack('after-style')

        <title>@yield('title')</title>
    </head>

    <body>

        <div class="screen-cover d-none d-xl-none"></div>

        <div class="row">
            <div class="col-12 col-lg-3 col-navbar d-none d-xl-block">
                @include('includes.backend.sidebar')
            </div>


            <div class="col-12 col-xl-9">
                @yield('content')
            </div>
        </div>

        @stack('before-script')
        @include('includes.backend.script')
        @stack('after-script')
    </body>
</html>
