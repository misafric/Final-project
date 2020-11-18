<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Cool E-shop</title>

    

</head>
<body>

    <title>Eshop</title>

    <link rel="stylesheet" href="{{ mix('css/app.css') }}">

    @yield('header')
    @yield('footer')
     @include('common/header')
    @include('common/footer')

</body>
</html>

