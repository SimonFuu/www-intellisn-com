@extends('layouts.common')
@section('main')
    <div id="header" class="product-nav-header navbar-toggleable-md sticky clearfix">
        <!-- TOP NAV -->
        <header id="topNav">
            <div class="container">
                <!-- Mobile Menu Button -->
                <button class="btn btn-mobile" data-toggle="collapse" data-target=".nav-main-collapse">
                    <i class="fa fa-bars"></i>
                </button>

                <!-- Logo -->
                <a class="logo float-left" href="{{ route(SITE . 'Index') }}">
                    <img class="header-logo-image" src="{{ CDN_SERVER }}/images/logo_dark.png" alt="" />
                </a>
                <div class="navbar-collapse collapse float-right nav-main-collapse">
                    <nav class="nav-main">

                        <!--
                            .nav-onepage
                            Required for onepage navigation links

                            Add .external for an external link!
                        -->
                        <ul id="topMain" class="nav nav-pills nav-main nav-onepage">
                            <li class="active"><!-- HOME -->
                                <a href="#home">
                                    HOME
                                </a>
                            </li>
                            <li><!-- FEATURES -->
                                <a href="#features">
                                    FEATURES
                                </a>
                            </li>
                            <li><!-- PRICING -->
                                <a href="#pricing">
                                    PRICING
                                </a>
                            </li>
                            <li><!-- TESTIMONIALS -->
                                <a href="#testimonials">
                                    TESTIMONIALS
                                </a>
                            </li>
                            <li><!-- PURCHASE -->
                                <a class="external" href={{ route(SITE . 'Product', 123) }}>
                                    PURCHASE
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </header>
    </div>
@endsection