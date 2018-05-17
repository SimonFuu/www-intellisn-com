<!-- TOP NAV -->
<header id="topNav">
    <div class="container">
        <!-- Mobile Menu Button -->
        <button class="btn btn-mobile" data-toggle="collapse" data-target=".nav-main-collapse">
            <i class="fa fa-bars"></i>
        </button>
        <!-- Logo -->
        <a class="logo float-left" href="{{ route(SITE . 'Index') }}">
            <img class="header-logo-image" src="{{ CDN_SERVER }}/images/logo_light.png" alt="" />
        </a>
        <ul class="float-right nav nav-pills nav-second-main has-topBar shopping-bag-icon">
            <li class="quick-cart">
                <a href="{{ route(SITE. 'ShoppingCart') }}">
                    <span class="badge badge-aqua badge-corner">9+</span>
                    <i class="fa fa-shopping-cart"></i>
                </a>
            </li>
        </ul>
        <div class="navbar-collapse float-right nav-main-collapse">
            <nav class="nav-main">
                <ul id="topMain" class="nav nav-pills nav-main nav-onepage site-nav-header-items">
                    <li class="active">
                        <a href="{{ route(SITE. 'Index') }}">
                            HOME
                        </a>
                    </li>
                    <li>
                        <a href="{{ route(SITE.'Contact') }}">
                            CONTACT
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</header>

