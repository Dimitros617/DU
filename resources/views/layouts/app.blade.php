<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!--

     -----------------------------------------------
     Tento systém vytvořil Dominik Frolík jako Bakalářksou práci:

     -----------------------------------------------


     -->

    <title>@yield('title') | DU</title>
    <link rel="icon" href="{{ URL::asset('img/logo_mini_transparent_square.png') }}">

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">


    <!-- Javascript -->
    <link href="http://code.jquery.com/ui/1.11.3/themes/smoothness/jquery-ui.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="http://code.jquery.com/ui/1.11.3/jquery-ui.min.js"></script>
    <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>

    <script src="{{ URL::asset('css/bootstrap/js/bootstrap.bundle.js') }}"></script>
    <script src="{{ URL::asset('css/bootstrap/js/bootstrap.esm.js') }}"></script>
    <script src="{{ URL::asset('css/bootstrap/js/bootstrap.js') }}"></script>
    <script src="{{ URL::asset('js/main.js') }}"></script>
    <script src="{{ URL::asset('js/dragable.js') }}"></script>
    <script  src="{{ URL::asset('js/sweetalert2/dist/sweetalert2.all.min.js') }}"></script>
    <script  src="{{ URL::asset('js/sweetalert2/dist/sweetalert2.js') }}"></script>

    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>



    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/main.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/buttons.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/animation.css') }}">
    <link rel="stylesheet" href="@yield('css')">
    <link rel="stylesheet" href="@yield('css2')">
    <link rel="stylesheet" href="@yield('css3')">
    <link rel="stylesheet" href="@yield('css4')">
    <link rel="stylesheet" href="@yield('css5')">

    <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/bootstrap/css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/bootstrap/css/bootstrap-grid.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/bootstrap/css/bootstrap-reboot.css') }}">
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <link rel="stylesheet" href="//cdn.quilljs.com/1.3.6/quill.bubble.css">

{{--    <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/bootstrap/css/bootstrap-utilities.css') }}">--}}


    <script src="https://cdn.jsdelivr.net/npm/promise-polyfill"></script>

    @section('link')
        @livewireStyles

        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}" defer></script>


</head>
<body class="font-sans antialiased">
<div class="min-h-screen bg-gray-100 bg-su-blue-texture " style="padding-bottom: 8rem" >
    @livewire('navigation-dropdown')

<!-- Page Content -->
    <main>
        {{ $slot }}
    </main>
{{--    <div class="footer">--}}

{{--        <span onclick="--}}

{{--             if(!isNaN(window.easterEggCount)){--}}
{{--                 window.easterEggCount++;--}}
{{--             }else {--}}
{{--                 window.easterEggCount = 0;--}}
{{--             }--}}

{{--             if(window.easterEggCount > 3){--}}
{{--            Swal.fire({--}}
{{--              title: 'Nice, objevil si mě XD',--}}
{{--               text: 'Víte, že dle průzkumu se 85% lidí snaží znovu usnout, aby dokončily svůj sen?',--}}
{{--              width: 600,--}}
{{--              padding: '3em',--}}
{{--              confirmButtonText: 'No to jsem jako nevěděl!',--}}
{{--              background: '#fff url(/user_files/trees.png)',--}}
{{--              backdrop: `--}}
{{--                rgba(0,0,123,0.4)--}}
{{--                url('/user_files/nyan-cat.gif')--}}
{{--                    left top--}}
{{--                    no-repeat--}}
{{--                    `--}}
{{--         })}--}}
{{--        ">©</span> <a href="http://www.dominikfrolik.cz/"> Dominik Frolík </a> |  Bakalářská práce 2021 pro <a href="https://www.zcu.cz/cs/index.html"> ZČU </a> v Plzni--}}

{{--    </div>--}}
</div>



@stack('modals')

@livewireScripts
</body>
</html>
