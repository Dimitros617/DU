
    <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Digitální učebnice</title>
    <link rel="icon" href="{{ URL::asset('img/logo_mini_transparent_square.png') }}">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/main.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/buttons.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/animation.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/bootstrap/css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/bootstrap/css/bootstrap-grid.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/bootstrap/css/bootstrap-reboot.css') }}">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="css/welcomeDefault.css">
    <link rel="stylesheet" type="text/css" href="css/welcome.css">


</head>
<body class="min-h-screen bg-gray-100 bg-su-blue-texture " style="padding-bottom: 8rem">

<div class="bg-white overflow-hidden shadow-xl sm:rounded-lg max-w-7xl mx-auto sm:px-6 lg:px-8" style="    margin-top: 15%;">
    <div class="container p-6 text-center text-su-blue mt-4">

        <h1 class="display-1 mb-4 text-su-orange">Ups!</h1>
        <div class="h6"> Aktuálně Vás nemůžeme registrovat. Nemámě žádnou výchozí roly, kterou bychom mohly přidělit.
            <br><br><b>Zkuste kontaktovat správce systému.</b>
        </div>
    </div>
</div>
</body>
</html>




