<div id="header" class="sub-nav-header navbar-toggleable-md sticky clearfix">
    <div class="container">
        <div class="float-left">
            Second header
        </div>
        @if(isset($productId))
            <div class="navbar-collapse collapse float-right nav-main-collapse">
                <nav class="nav-main">
                    <ul id="topMain" class="nav nav-pills nav-main nav-onepage sub-nav-header-items">
                        <li class="active sub-nav-header-item"><!-- HOME -->
                            <a href="#home">
                                HOME
                            </a>
                        </li>
                        <li class="sub-nav-header-item"><!-- FEATURES -->
                            <a href="#features">
                                FEATURES
                            </a>
                        </li>
                        <li class="sub-nav-header-item"><!-- PRICING -->
                            <a href="#pricing">
                                PRICING
                            </a>
                        </li>
                        <li class="sub-nav-header-item"><!-- TESTIMONIALS -->
                            <a href="#testimonials">
                                TESTIMONIALS
                            </a>
                        </li>
                        <li class="sub-nav-header-item">
                            <button data-toggle="modal" data-target="#backersModal">
                                ALL BACKERS
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