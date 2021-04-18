<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <!--web fonts-->
    <link href="https://fonts.googleapis.com/css?family=Nunito:300,400,600,700,800" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lora:400i" rel="stylesheet">

    <!--basic styles-->
    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/fontawesome/css/all.min.css')}}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/custom-icon/style.css')}}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/vl-nav/css/core-menu.css')}}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/animate.min.css')}}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/magnific-popup/magnific-popup.css')}}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/owl/assets/owl.carousel.min.css')}}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/owl/assets/owl.theme.default.min.css')}}" rel="stylesheet">

    <!--custom styles-->
    <link href="{{ asset('assets/css/main.css')}}" rel="stylesheet">

    <!--[if (gt IE 9) |!(IE)]><!-->
    <!--<link rel="stylesheet" href="assets/vendor/custom-nav/css/effects/fade-menu.css"/>-->
    <link rel="stylesheet" href="{{ asset('assets/vendor/vl-nav/css/effects/slide-menu.css')}}"/>
    <!--<![endif]-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.2.1/Chart.js"></script>


    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">


</head>
<body <?php if(Route::currentRouteName() == 'login'){ echo 'style="height: 100%"'; }?>>
    <div id="app" <?php if(Route::currentRouteName() == 'login'){ echo 'style="background-image: url(images/bg.png);background-size: cover;"'; }?>>
        <section class="row no-gutters align-items-center p-0 bg-white border-bottom ">
            <div class="container py-3">
                <a class="mr-5" href="{{ route('home') }}"><img style="height: 50px;" src="{{ asset('/assets/img/logo.svg') }}"></a>
                
                <!-- <a href="https://www.cyber-training.ru/ru/connect" class="btn btn-pill btn-theme float-right">ВОЙТИ В ИГРУ</a> -->
                @auth
                <a href="https://cabinet.digtrack.ru/home" class="item-style px-2">Сотрудники</a> <a href="https://cabinet.digtrack.ru/statistic" class="item-style px-2">Статистика</a> <a href="https://cabinet.digtrack.ru/departments" class="item-style px-2">Департаменты (отделы)</a> <a href="https://cabinet.digtrack.ru/positions " class="item-style pl-2">Должности</a>
                <div class="float-right"><span style="
                    display: block;
                    font-weight: 800;
                ">₽ {{ number_format(Auth::user()->score, 2) }}</span> 
                <small class="text-muted">{{ Auth::user()->name }}</small></div>
                @endauth                            
            </div>
        </section>
       

        @yield('content')
    </div>

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
<script>

    jQuery(document).ready(function() {
        var chartDiv = $("#barChart");
        // var chartDiv2 = $("#barChart2");
        var chartDiv3 = $("#barChart3");

        var ctx = document.getElementById("barChart2").getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ["sunday", "monday", "tuesday", "wednesday", "thursday", "friday", "saturday"],
                datasets: [{
                    label: 'Количество тестирований',
                    data: [20000, 14000, 12000, 15000, 18000, 19000, 22000],
                }]
            },
        });

        var myChart = new Chart(chartDiv, {
            type: 'pie',
            data: {
                labels: ["Успешно прошли обучение", "Плохо прошли обучение"],
                datasets: [
                {
                    data: [21, 39],
                    backgroundColor: [
                    "#FF6384",
                    "#4BC0C0"
                    ]
                }]
            },
            options: {
                title: {
                    display: false,
                    text: 'Pie Chart'
                },
                responsive: true,
                maintainAspectRatio: false,
            }
        });

        var myChart2 = new Chart(chartDiv3, {
            type: 'pie',
            data: {
                labels: ["Успешно прошли тестирование", "Плохо прошли тестирование"],
                datasets: [
                {
                    data: [50, 10],
                    backgroundColor: [
                        "#FF6384",
                        "#4BC0C0"
                    ]
                }]
            },
            options: {
                title: {
                    display: false,
                    text: 'Pie Chart'
                },
                responsive: true,
                maintainAspectRatio: false,
            }
        });
    
    
    
    
    });


</script>

<!--basic scripts-->
<script src="{{ asset('assets/vendor/jquery/jquery.min.js')}}"></script>
<script src="{{ asset('assets/vendor/popper.min.js')}}"></script>
<script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
<script src="{{ asset('assets/vendor/vl-nav/js/vl-menu.js')}}"></script>
<script src="{{ asset('assets/vendor/magnific-popup/jquery.magnific-popup.min.js')}}"></script>
<script src="{{ asset('assets/vendor/owl/owl.carousel.min.js')}}"></script>
<script src="{{ asset('assets/vendor/jquery.animateNumber.min.js')}}"></script>
<script src="{{ asset('assets/vendor/jquery.countdown.min.js')}}"></script>
<script src="{{ asset('assets/vendor/typist.js')}}"></script>
<script src="{{ asset('assets/vendor/jquery.isotope.js')}}"></script>
<script src="{{ asset('assets/vendor/imagesloaded.js')}}"></script>
<script src="{{ asset('assets/vendor/visible.js')}}"></script>
<script src="{{ asset('assets/vendor/wow.min.js')}}"></script>

<script src="{{ asset('assets/js/mask.j')}}s"></script>

<!--basic scripts initialization-->
<script src="{{ asset('assets/js/scripts.js')}}"></script>
<script src="{{ asset('assets/js/custom.js')}}"></script>
</body>
</html>
