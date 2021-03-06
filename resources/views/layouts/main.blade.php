<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Eshop</title>

    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    @yield('meta')

</head>
<body>

    @include('common/header')

    @include('common/nav_header')

    @yield('content')
    
    @include('common/footer')

</body>
</html>

