<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    {{-- Bootstrap File--}}
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    {{--Custom CSS Files--}}
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    {{--Datatables--}}
    <link rel="stylesheet" href="{{ asset('assets/css/dataTables.css') }}">
    @stack('style')
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2 p-0">
            {{--Sidebar--}}
            @include('layout.sidebar')
            </div>
            <div class="col-md-10">
            {{--Content--}}
            @yield('main')
            </div>
        </div>
    </div>
    {{--Jquery Scripts--}}
    <script src="{{ asset('assets/js/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/dataTables.js') }}"></script>
    @stack('script')
</body>
</html>
