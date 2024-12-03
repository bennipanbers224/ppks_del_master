<!DOCTYPE html>
<html lang="id">


<head>
    <link rel="icon" href="{{ asset('images/favicon.ico') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{asset('css/custom.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', ' PPKS IT DEL')</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>


<body>
    @include('layouts.umum.header')

    <main>
        @yield('content')
    </main>

    @include('layouts.umum.footer')
</body>

</html>