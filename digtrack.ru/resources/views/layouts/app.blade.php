<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="google" content="notranslate">

    <link rel="icon" type="image/png" href="{{ asset('16x16.png') }}" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Digital Track</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Nunito:300,400,600,700,800" rel="stylesheet">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.2.0/socket.io.js"></script>
    <script src="https://kit.fontawesome.com/830c83497f.js" crossorigin="anonymous"></script>



    <script>
        document.oncontextmenu = cmenu; function cmenu() { return false; } 
        //window.onbeforeunload = function() { return 'Reloading block'; }

        //this code handles the F5/Ctrl+F5/Ctrl+R
        {{-- Добавить отслеживание и отключение всех клавиш кроме текстовых --}}
        // document.onkeydown = function(){
        //     switch (event.keyCode){
        //         case 116 : //F5 button
        //             event.returnValue = false;
        //             event.keyCode = 0;
        //             return false;
        //         case 82 : //R button
        //             if (event.ctrlKey){ 
        //                 event.returnValue = false;
        //                 event.keyCode = 0;
        //                 return false;
        //             }
        //     }
        // }
     </script>

  
    <style>
        *{
            font-family: 'Nunito', sans-serif;
        }
    </style>

    @stack('styles')
    @stack('scripts')
</head>
<body>
    <div id="app">
        @yield('content')
    </div>

    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/mask.js') }}"></script>
    <script src="{{ asset('js/custom.js') }}"></script>
   

</body>
</html>
