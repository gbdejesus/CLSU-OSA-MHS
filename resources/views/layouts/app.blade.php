<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>CLSU-OSA: Mental Health Support</title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}" />

    <!-- Font Awesome icons (free version)-->
    <script src="{{ asset('js/fa.js') }}" defer></script>

    <!-- Google fonts-->
    <link href="{{ asset('fonts/montserrat.css') }}" rel="stylesheet">
    <link href="{{ asset('fonts/italic.css') }}" rel="stylesheet">
    <link href="https://api.fontshare.com/v2/css?f[]=general-sans@500&f[]=Oswald@400&f[]=clash-grotesk@400&f[]=ranade@400&f[]=archivo@400&f[]=clash-display@600&display=swap" rel="stylesheet">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/scripts.js') }}" defer></script>

    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    <link href="{{asset('css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('backend/css/font-muli.css')}}" rel='stylesheet' type='text/css'>
    <link href="{{asset('backend/css/themify-icons.css')}}" rel="stylesheet">

</head>
<body>
    @if (session('role') !== 'ADMIN')
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg bg-secondary text-uppercase fixed-top" id="mainNav">
            <div class="container">
                <a  href="{{ url('/') }}"><img class="mr-2" src="{{ asset('images/clsu-logo.jpg') }}" alt="..." style="max-height: 50px; margin-right: 10px;"/>
                <a class="navbar-brand" href="{{ url('/') }}">
                    CLSU-OSA: Mental Health Support
                </a> </a>
                <button class="navbar-toggler text-uppercase font-weight-bold bg-primary text-white rounded" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    Menu
                    <i class="fas fa-bars"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto">
                        @guest
                            <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="{{ url('/counsellors/guest') }}">Counsellors</a></li>
                            <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="{{ url('/faq/guest') }}">FAQ</a></li>
                            <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="{{ url('/login') }}">Login</a></li>
                            @if (Route::has('register'))
                                <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="{{ url('/register') }}">Register</a></li>
                            @endif
                        @else
                            <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="{{ url('/home') }}">INBOX</a></li>
                            <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="{{ url('/counsellors') }}">Counsellors</a></li>
                            <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="{{ url('/faq') }}">FAQ</a></li>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle mt-2" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Masthead-->
        <header class="masthead bg-primary text-white text-center" style="padding-top: 170px; padding-bottom: 0px !important;">
            <div id="app" class="page-section align-items-center pt-0" style="margin-left: 30px; margin-right: 30px;">
                @yield('content')
            </div>
        </header>
        <!-- Footer-->
        <footer class="footer text-center">
    <div class="container">
        <div class="row">
            <!-- Footer Location-->
            <div class="col-lg-4 mb-5 mb-lg-0">
                <h4 class="text-uppercase mb-4 me-4 ms-4"  style="text-align: left;">Contact details</h4>
                <p class="lead mb-0 me-4 ms-4" style="text-align: left;">
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
        <!-- Copyright Section-->

    @else
        @guest
            <!-- Navigation-->
            <nav class="navbar navbar-expand-lg bg-secondary text-uppercase fixed-top" id="mainNav">
                <div class="container">
                    <a href="{{ url('/')}}"><img class="mr-2" src="{{ asset('images/clsu-logo.jpg') }}" alt="..." style="max-height: 50px; margin-right: 10px;"/>
                    <a class="navbar-brand" href="{{ url('/') }}">
                        CLSU-OSA: Mental Health Support
                    </a></a>
                    <button class="navbar-toggler text-uppercase font-weight-bold bg-primary text-white rounded" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                        Menu
                        <i class="fas fa-bars"></i>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ms-auto">
                            @guest
                                <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="{{ url('/counsellors/guest') }}">Counsellors</a></li>
                                <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="{{ url('/faq/guest') }}">FAQ</a></li>
                                <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="{{ url('/login') }}">Login</a></li>
                                @if (Route::has('register'))
                                    <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="{{ url('/register') }}">Register</a></li>
                                @endif
                            @else
                                <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="{{ url('/home') }}">INBOX</a></li>
                                <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="{{ url('/counsellors') }}">Counsellors</a></li>
                                <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="{{ url('/faq') }}">FAQ</a></li>
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle mt-2" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ Auth::user()->name }} <span class="caret"></span>
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            @endguest
                        </ul>
                    </div>
                </div>
            </nav>
            <!-- Masthead-->
            <header class="masthead bg-primary text-white text-center" style="padding-top: 170px; padding-bottom: 0px !important;">
                <div id="app" class="page-section align-items-center pt-0" style="margin-left: 30px; margin-right: 30px;">
                    @yield('content')
                </div>
            </header>
            <!-- Footer-->
            <footer class="footer text center">
    <div class="container">
        <div class="row">
            <!-- Footer Location-->
            <div class="col-lg-4 mb-5 mb-lg-0">
                <h4 class="text-uppercase mb-4 me-4 ms-4"  style="text-align: left;">Contact details</h4>
                <p class="lead mb-0 me-4 ms-4" style="text-align: left;">
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
                <h4 class="text-uppercase mb-4 me-4 ms-4"  style="text-align: right;">About the OSA</h4>
                <p class="lead mb-0 me-4 ms-4" style="text-align: right;">
                The OSA functions as a hub for student-related information, activities, and services, addressing their co-curricular and extra-curricular needs. It strives to foster students' talent, potential, and leadership skills by focusing on self-growth, cooperative learning, leadership development, productive leisure, and cross-cultural adjustment.</p>
            </div>
        </div>
    </div>
</footer>
            <!-- Copyright Section-->

        @else
            @yield('content')
        @endguest
    @endif

<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
<!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
<!-- * *                               SB Forms JS                               * *-->
<!-- * * Activate your form at https://startbootstrap.com/solution/contact-forms * *-->
<!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
<script src="{{ asset('js/sb-forms-0.4.1.js') }}"></script>
</body>
</html>
