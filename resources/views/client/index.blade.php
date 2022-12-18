<!DOCTYPE html>
<html lang="en">

<head>
    <title>VMB</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,700,900|Display+Playfair:200,300,400,700">
    <link rel="stylesheet" href="{{ asset('assets/fonts/icomoon/style.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/jquery-ui.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/owl.theme.default.min.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-datepicker.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/fonts/flaticon/font/flaticon.css') }}">



    <link rel="stylesheet" href="{{ asset('assets/css/aos.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

</head>

<body>

    <div class="site-wrap">
        <x-navbar />

        <div class="site-blocks-cover overlay" style="background-image: url(assets/images/hero_bg_1.jpg);"
            data-aos="fade" data-stellar-background-ratio="0.5">
            <div class="container">
                <div class="row align-items-center justify-content-center text-center">

                    <div class="col-md-8" data-aos="fade-up" data-aos-delay="400">


                        {{-- <h1 class="text-white font-weight-light mb-5 text-uppercase font-weight-bold">Pengiriman Truk Kargo</h1>
            <p><a href="#" class="btn btn-primary py-3 px-5 text-white">Order Sekarang</a></p> --}}

                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row align-items-center no-gutters align-items-stretch overlap-section">
                <div class="col-md-4">
                    <div class="feature-1 pricing h-100 text-center">
                        <div class="icon">
                            <span class="icon-dollar"></span>
                        </div>
                        <h2 class="my-4 heading">Best Prices</h2>
                        <p>We pride ourselves in providing the best services and also giving the best prices for it</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-1 pricing bg-dark h-100 text-center">
                        <div class="icon">
                            <span class="icon-handshake-o"></span>
                        </div>
                        <h2 class="my-4 heading">Trusted</h2>
                        <p>VMB has been working in this industry for more than 20 years, and has worked with various
                            clients since then and is still continuing today</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-3 pricing h-100 text-center">
                        <div class="icon">
                            <span class="icon-phone"></span>
                        </div>
                        <h2 class="my-4 heading">24/7 Support</h2>
                        <p>You could contact us anywhere and anytime through our whatsapp, feel free to ask us</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="site-section" id="services">
            <div class="container">
                <div class="row justify-content-center mb-5">
                    <div class="col-md-7 text-center border-primary">
                        <h2 class="mb-0 text-primary">SERVICES</h2>
                        <p class="color-black-opacity-5">We offer the following services</p>
                    </div>
                </div>
                <div class="row align-items-stretch">
                    <div class="col-md-6 col-lg-4 mb-4 mb-lg-0">
                        <div class="unit-4 d-flex">
                            <div class="unit-4-icon mr-4" style="width: 48px; height: 48px"><span class="text-primary">
                                    <svg class="unit-4-icon text-primary" style="height: 48px"
                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                                        <path fill="#107F1B"
                                            d="M208 48C208 74.51 186.5 96 160 96C133.5 96 112 74.51 112 48C112 21.49 133.5 0 160 0C186.5 0 208 21.49 208 48zM152 352V480C152 497.7 137.7 512 120 512C102.3 512 88 497.7 88 480V256.9L59.43 304.5C50.33 319.6 30.67 324.5 15.52 315.4C.3696 306.3-4.531 286.7 4.573 271.5L62.85 174.6C80.2 145.7 111.4 128 145.1 128H174.9C208.6 128 239.8 145.7 257.2 174.6L315.4 271.5C324.5 286.7 319.6 306.3 304.5 315.4C289.3 324.5 269.7 319.6 260.6 304.5L232 256.9V480C232 497.7 217.7 512 200 512C182.3 512 168 497.7 168 480V352L152 352z" />
                                    </svg>
                                </span></div>
                            <div>
                                <h3>Custom Clearance</h3>
                                <p>One of our services that would be the act of moving goods through customs so they can
                                    enter the country</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4 mb-4 mb-lg-0">
                        <div class="unit-4 d-flex">
                            <div class="unit-4-icon mr-4"><span class="text-primary flaticon-frontal-truck"></span>
                            </div>
                            <div>
                                <h3>Ground Shipping</h3>
                                <p>We do our ground shipments by using our fleet of trucks in order to deliver the goods
                                    provided by our clients</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4 mb-4 mb-lg-0">
                        <div class="unit-4 d-flex">
                            <div class="unit-4-icon mr-4"><span class="text-primary flaticon-barn"></span></div>
                            <div>
                                <h3>Warehousing</h3>
                                <p>We also provide the ability for our clients to store their goods in a warehouse that
                                    we would rent from a trusted provider</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>


        <div class="site-section bg-light" id="achievements">
            <div class="container">
                <div class="row justify-content-center mb-5">
                    <div class="col-md-7 text-center border-primary">
                        <h2 class="font-weight-light text-primary">Achievements</h2>
                        <p class="color-black-opacity-5">We Offer The Following Services</p>
                    </div>
                </div>
                <div class="row align-items-stretch">
                    <div class="col-md-6 col-lg-4 mb-4 mb-lg-4">
                        <div class="unit-4 d-flex align-items-center flex-column">
                            <img class="" height="250px" src="{{ asset('assets/images/achievements/1.png') }}"
                                alt="">
                            <h3>Best Logistic Vendor</h3>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4 mb-4 mb-lg-4">
                        <div class="unit-4 d-flex align-items-center flex-column">
                            <img class="" height="250px" src="{{ asset('assets/images/achievements/2.png') }}"
                                alt="">
                            <h3>Best Delivery Achievement</h3>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4 mb-4 mb-lg-4">
                        <div class="unit-4 d-flex align-items-center flex-column">
                            <img class="" height="250px" src="{{ asset('assets/images/achievements/3.png') }}"
                                alt="">
                            <h3>Piala Bergilir</h3>
                        </div>
                    </div>


                    <div class="col-md-6 col-lg-4 mb-4 mb-lg-4">
                        <div class="unit-4 d-flex align-items-center flex-column">
                            <img class="mb-3" height="250px" src="{{ asset('assets/images/achievements/4.png') }}"
                                alt="">
                            <h3>Best Trucking Company Management</h3>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4 mb-4 mb-lg-4">
                        <div class="unit-4 d-flex align-items-center flex-column">
                            <img class="mb-3" height="250px" src="{{ asset('assets/images/achievements/5.png') }}"
                                alt="">
                            <h3>Winner TC Defensive & Driving Behavior</h3>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4 mb-4 mb-lg-4">
                        <div class="unit-4 d-flex align-items-center flex-column">
                            <img class="mb-3" height="250px" src="{{ asset('assets/images/achievements/6.png') }}"
                                alt="">
                            <h3>Best Trucking Company</h3>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="site-section border-bottom" id="clients">
            <div class="container">

                <div class="row justify-content-center mb-5">
                    <div class="col-md-7 text-center border-primary">
                        <h2 class="font-weight-light text-primary">CLIENTS</h2>
                    </div>
                </div>

                <div class="slide-one-item home-slider owl-carousel">
                    <div>
                        <div class="testimonial">
                            <figure class="mb-4">
                                <img src="{{ asset('assets/images/toyota.jpg') }}" alt="Image"
                                    class="img-fluid mb-3">
                                <p>Toyota Motor Manufacturing Indonesia</p>
                            </figure>
                            <blockquote>
                                <p>"TMMIN is a part of Toyota Indonesia which focuses on manufacturing and assembling
                                    Toyota products in Indonesia. Not only that, they also fulfill the needs in the
                                    country itself and also export to more than 70 countries"</p>
                            </blockquote>
                        </div>
                    </div>
                    <div>
                        <div class="testimonial">
                            <figure class="mb-4">
                                <img src="{{ asset('assets/images/TAM.jpg') }}" alt="Image"
                                    class="img-fluid mb-3">
                                <p>Toyota Astra Motor</p>
                            </figure>
                            <blockquote>
                                <p>
                                    "TAM focuses on distributing and part services in Indonesia and also acts as a sales
                                    agent which imports toyota products"</p>
                            </blockquote>
                        </div>
                    </div>

                    <div>
                        <div class="testimonial">
                            <figure class="mb-4">
                                <img src="{{ asset('assets/images/daihatsu.png') }}" alt="Image"
                                    class="img-fluid mb-3">
                                <p>PT Astra Daihatsu Motor</p>
                            </figure>
                            <blockquote>
                                <p>
                                    "is an automobile manufacturing company based in Jakarta, Indonesia. It is a joint
                                    venture company between Daihatsu, Astra International and Toyota Tsusho. It is the
                                    largest car manufacturer in Indonesia by production output and installed capacity,
                                    and has been second best-selling car brand behind Toyota."</p>
                            </blockquote>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <x-footer />
    </div>

    <script src="{{ asset('assets/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery-migrate-3.0.1.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery-ui.js') }}"></script>
    <script src="{{ asset('assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.stellar.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.countdown.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('assets/js/aos.js') }}"></script>

    <script src="{{ asset('assets/js/main.js') }}"></script>

</body>

</html>
