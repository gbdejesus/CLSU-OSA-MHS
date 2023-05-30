<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>CLSU-OSA: Mental Health Support</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}" />
    <!-- Font Awesome icons (free version)-->
    <script src="{{ asset('js/fa.js') }}" defer></script>
    <!-- Google fonts-->
    <link href="{{ asset('fonts/montserrat.css') }}" rel="stylesheet">
    <link href="{{ asset('fonts/italic.css') }}" rel="stylesheet">
    <link href="https://api.fontshare.com/v2/css?f[]=general-sans@500&f[]=satoshi@500&f[]=clash-grotesk@400&f[]=ranade@400&f[]=archivo@400&f[]=clash-display@600&display=swap" rel="stylesheet">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/scripts.js') }}" defer></script>
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    <link href="{{asset('css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('backend/css/font-muli.css')}}" rel='stylesheet' type='text/css'>
    <link href="{{asset('backend/css/themify-icons.css')}}" rel="stylesheet">
</head>
<body id="clsu-osa-mental-health-support">
<!-- Navigation-->
<nav class="navbar navbar-expand-lg bg-secondary text-uppercase fixed-top" id="mainNav">
    <div class="container">

        <a href="{{ url('/') }}" ><img class="mr-2" src="{{ asset('images/clsu-logo.jpg') }}" alt="..." style="max-height: 50px; margin-right: 10px;"/>
        <a class="navbar-brand" href="#clsu-osa-mental-health-support">
            CLSU-OSA:
            Mental Health Support
        </a></a>
        <button class="navbar-toggler text-uppercase font-weight-bold bg-primary text-white rounded" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            Menu
            <i class="fas fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ms-auto">
                @auth
                    <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="{{ url('/home') }}">Home</a></li>
                    @if (session('role') !== 'ADMIN')
                        <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="{{ url('/counsellors') }}">Counsellors</a></li>
                        <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="{{ url('/faq') }}">FAQ</a></li>
                    @endif
                @else
                    <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="{{ url('/counsellors/guest') }}">Counsellors</a></li>
                    <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="{{ url('/faq/guest') }}">FAQ</a></li>
                    <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="{{ url('/login') }}">Login</a></li>

                    @if (Route::has('register'))
                        <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="{{ url('/register') }}">Register</a></li>
                    @endif
                @endauth
            </ul>
        </div>
    </div>
</nav>
<!-- Masthead-->
<header class="masthead bg-primary text-white text-center">
    <div class="container d-flex align-items-center flex-column">
        <!-- Masthead Avatar Image-->
        <img class="masthead-avatar mb-5" src="{{ asset('images/clsu-logo.jpg') }}" alt="..." />
        <!-- Masthead Heading-->
        <h3 class="masthead-heading text-uppercase mb-0" style="font-family: 'Nunito', sans-serif; font-weight: bold;">
            CLSU-OSA: <br>
            Mental Health Support <br>
            Chat System
        </h3>
        <!-- Icon Divider-->
        <div class="divider-custom divider-light">
            <div class="divider-custom-line"></div>
            <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
            <div class="divider-custom-line"></div>
        </div>
        <!-- Masthead Subheading-->
        <p class="masthead-subheading font-weight-light mb-0" style="font-family: 'Archivo', sans-serif;">
            As the heart of the guidance program, the Counseling Service aims to help each individual understand herself/ 
himself better in order to cope with the stresses of life, to make sound 
decisions and life goals, and achieve self-direction.</p>
    </div>
</header>
<!-- Footer-->
<footer class="footer text-center">
    <div class="container">
        <div class="row">
            <!-- Footer Location-->
            <div class="col-lg-4 mb-5 mb-lg-0" style="text-align: left;">
                <h4 class="text-uppercase mb-4 me-4 ms-4">Contact details</h4>
                <p class="lead mb-0 me-4 ms-4" >
                <a href="https://www.facebook.com/officeofstudentaffairsCLSU" style="text-decoration: none; color: white;"><i class="fab fa-fw fa-facebook-f"></i>&nbsp;&nbsp;&nbsp; Office of Student Affairs Facebook Page</a>
                <br><br>
                <i class="ti ti-location-pin"></i>&nbsp;&nbsp;&nbsp; Central Luzon State University, Science City of Muñoz Nueva Ecija, Philippines
                <br><br>
                <a href="mailto:osa@clsu.edu.ph?subject=Mail from OSA Mental Health Support" style="text-decoration: none; color: white;"><i class="ti ti-email"></i>&nbsp;&nbsp;&nbsp; osa@clsu.edu.ph</a>
                <br><br>
                <a href="tel:(044)-940-7030" style="text-decoration: none; color: white;"><i class="fa-solid fa-phone"></i>&nbsp;&nbsp;&nbsp; (044) 940 7030</a>
                </p>
            </div>
            <!-- Footer Social Icons-->
            <div class="col-lg-4 mb-5 mb-lg-0">
                <h4 class="mb-4"><img src="{{ asset('images/clsu-logo-bw1.png') }}" alt="..." style="max-height: 150px; padding-top:20px;"/></h4>
            <h6 style="font-family:'Nunito', sans-serif; font-size: 25px;">CLSU-OSA: <br> MENTAL HEALTH SUPPORT<h6>
            </div>
            <!-- Footer About Text-->
            <div class="col-lg-4">
                <h4 class="text-uppercase mb-4 me-4 ms-4" style="text-align: right;">About the OSA</h4>
                <p class="lead mb-0 me-4 ms-4" style="text-align: right;">
                The OSA functions as a hub for student-related information, activities, and services, addressing their co-curricular and extra-curricular needs. It strives to foster students' talent, potential, and leadership skills by focusing on self-growth, cooperative learning, leadership development, productive leisure, and cross-cultural adjustment.</p>
            </div>
        </div>
    </div>
</footer>

<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('js/sb-forms-0.4.1.js') }}"></script>
</body>
</html>
