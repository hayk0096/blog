<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Book Author</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
              integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
              crossorigin="anonymous">

        <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/favicon.png') }}">


        <!-- Styles -->
        <style>
            body {
                background: url( {{ asset('images/books/Literature-books-cover_2560x1600.jpg') }} ) no-repeat;
                background-size: cover;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #f7fcff;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .links > a:hover,
            .links > a.active {
                text-decoration: underline;
                color: #bfb3ff;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
        @yield('css')
    </head>
    <body>

    @php $route = request()->route()->getName() @endphp


    {{--        <div class="flex-center position-ref full-height">--}}
        <div class="position-ref full-height pt-3">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Profile</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">
{{--                <div class="title m-b-md">--}}
{{--                    Books and Authors--}}
{{--                </div>--}}

                <div class="links">
                    <a href="{{ route('books.list') }}" class="{{ preg_match('/(book*)/m', $route) ? 'active' : '' }}">Books</a>
                    <a href="{{ route('authors.list') }}" class="{{ preg_match('/(author*)/m', $route) ? 'active' : '' }}">Authors</a>
                </div>

                <div id="content">
                    @yield('content')
                </div>
            </div>
        </div>

    @yield('js')
    </body>
</html>
