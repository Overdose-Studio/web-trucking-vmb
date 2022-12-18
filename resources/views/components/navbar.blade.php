<div class="site-mobile-menu">
    <div class="site-mobile-menu-header">
        <div class="site-mobile-menu-close mt-3">
            <span class="icon-close2 js-menu-toggle"></span>
        </div>
    </div>
    <div class="site-mobile-menu-body"></div>
</div>

<header class="site-navbar py-3" role="banner">

    <div class="container">
        <div class="row align-items-center">

            <div class="col-11 col-xl-2">
                <h1 class="mb-0"><a href="{{ route('landing') }}" class="text-white h2 mb-0"><img height="70"
                            src="{{ asset('assets/images/LOGO VMB-1.png') }}" alt=""></a></h1>
            </div>
            <div class="col-12 col-md-10 d-none d-xl-block">
                <nav class="site-navigation position-relative text-right" role="navigation">
                    <ul class="site-menu js-clone-nav mx-auto d-none d-lg-block">
                        <li><a href="{{ route('landing') }}#home">Home</a></li>
                        <li><a href="{{ route('about') }}">About Us</a></li>
                        <li><a href="{{ route('landing') }}#services">Services</a></li>
                        <li><a href="{{ route('landing') }}#achievements">Achievements</a></li>
                        <li><a href="{{ route('landing') }}#clients">Clients</a></li>
                        <li><a href="{{ route('landing') }}#contacts">Contact</a></li>
                        {{-- <li><a href="{{ route('customer.login') }}">Login</a></li> --}}
                    </ul>
                </nav>
            </div>


            <div class="d-inline-block d-xl-none ml-md-0 mr-auto py-3" style="position: relative; top: 3px;"><a
                    href="#" class="site-menu-toggle js-menu-toggle text-white"><span
                        class="icon-menu h3"></span></a></div>

        </div>

    </div>
    </div>

</header>
