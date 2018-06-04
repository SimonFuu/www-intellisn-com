<div id="header" class="sub-nav-header navbar-toggleable-md sticky clearfix">
    <div class="container">
        <div class="float-left">
            <strong>{{ SECOND_HEADER }}</strong>
        </div>
        @if(isset($productId))
            <div class="navbar-collapse collapse float-right nav-main-collapse">
                <nav class="nav-main">
                    <ul id="topMain" class="nav nav-pills nav-main nav-onepage sub-nav-header-items">
                        <li class="active sub-nav-header-item"><!-- HOME -->
                            <a href="#overview">
                                Overview
                            </a>
                        </li>
                        <li class="sub-nav-header-item"><!-- FEATURES -->
                            <a href="#domi">
                                'Domi' Experience
                            </a>
                        </li>
                        <li class="sub-nav-header-item"><!-- PRICING -->
                            <a href="#tech">
                                Tech Specs
                            </a>
                        </li>
                        <li class="sub-nav-header-item"><!-- TESTIMONIALS -->
                            <a href="{{ route(SITE . 'ProductSupport', ['id' => '6402415426629795841']) }}">
                                Support
                            </a>
                        </li>
                        <li class="sub-nav-header-item">
                            <button data-toggle="modal" data-target="#backersModal">
                                All Backers
                            </button>
                        </li>
                        <li>
                            <span>
                                <a href="{{ route(SITE . 'Product', ['id' => '6402415426629795841']) }}" class="btn btn-sm btn-primary">
                                    <strong>Buy</strong>
                                </a>
                            </span>
                        </li>
                    </ul>
                </nav>
            </div>
        @endif
    </div>
</div>