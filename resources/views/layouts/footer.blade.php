<div class="container">
    <div class="row">
        @if(SITE == 'global')
            <div class="col-md-4">
                <!-- Footer Logo -->
                <img class="footer-logo" src="{{ CDN_SERVER }}/images/logo-footer.png" alt="">
                <!-- Small Description -->
                <p>Intellisn, a group of dreamers creating excellent products for people's daily life. A team of engineers but also enthusiastic designers who focus on details with unique understanding of user experience.</p>
                <!-- Contact Address -->
                <div>
                    <ul class="list-unstyled">
                        <li class="">
                            Illinois, United States
                        </li>
                        <li class="">
                            <a href="mailto:contact@intellisn.com">contact@intellisn.com</a>
                        </li>
                    </ul>
                </div>
                <!-- /Contact Address -->
            </div>
            <div class="col-md-4">
                <!-- Links -->
                <h4 class="letter-spacing-1"></h4>
                <ul class="list-unstyled">
                    <li><a href="{{ route(SITE . 'Index') }}">Home</a></li>
                    <li><a href="{{ route(SITE . 'Contact') }}">Contact</a></li>
                    <li><a href="{{ route(SITE . 'OrderInquiryForm') }}">Order Inquiry</a></li>
                    {{--<li><a href="#">About Us</a></li>--}}
                    {{--<li><a href="#">Our Services</a></li>--}}
                    {{--<li><a href="#">Our Clients</a></li>--}}
                    {{--<li><a href="#">Our Pricing</a></li>--}}
                    {{--<li><a href="#">Smarty Tour</a></li>--}}
                    {{--<li><a href="#">Contact Us</a></li>--}}
                </ul>
                <!-- /Links -->
            </div>
            <div class="col-md-4">
                <!-- Newsletter Form -->
                <h4 class="letter-spacing-1">KEEP IN TOUCH</h4>
                <p>Subscribe to Our Newsletter to get Important News &amp; Offers</p>
                <form class="validate" action="{{ route(SITE . 'StoreSubscription') }}" method="post" novalidate="novalidate">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                        <input type="email" id="email" name="email" class="form-control required" placeholder="Enter your Email">
                        <span class="input-group-btn"><button class="btn btn-success" type="submit">Subscribe</button></span>
                    </div>
                    <div class="ajax-form-alert">

                    </div>
                </form>
                <!-- /Newsletter Form -->
                <!-- Social Icons -->
                <div class="mt-20">
                    <a href="https://www.facebook.com/intellisn" class="social-icon social-icon-border social-facebook float-left" target="_blank" data-toggle="tooltip" data-placement="top" title="" data-original-title="Facebook">
                        <i class="icon-facebook"></i>
                        <i class="icon-facebook"></i>
                    </a>
                    <a href="https://twitter.com/intellisn" class="social-icon social-icon-border social-twitter float-left" target="_blank" data-toggle="tooltip" data-placement="top" title="" data-original-title="Twitter">
                        <i class="icon-twitter"></i>
                        <i class="icon-twitter"></i>
                    </a>
                </div>
                <!-- /Social Icons -->
            </div>
        @elseif(SITE == 'china')
            <div class="col-md-4">
                <!-- Footer Logo -->
                <img class="footer-logo" src="{{ CDN_SERVER }}/images/logo-footer.png" alt="">
                <!-- Small Description -->
                <p>Intellisn, a group of dreamers creating excellent products for people's daily life. A team of engineers but also enthusiastic designers who focus on details with unique understanding of user experience.</p>
                <!-- Contact Address -->
                <div>
                    <ul class="list-unstyled">
                        <li class="">
                            Illinois, United States
                        </li>
                        <li class="">
                            <a href="mailto:contact@intellisn.com">contact@intellisn.com</a>
                        </li>
                    </ul>
                </div>
                <!-- /Contact Address -->
            </div>
            <div class="col-md-4">
                <!-- Links -->
                <h4 class="letter-spacing-1"></h4>
                <ul class="list-unstyled">
                    <li><a href="{{ route(SITE . 'Index') }}">首页</a></li>
                    <li><a href="{{ route(SITE. 'ProductSupport', ['id' => '6402415426629795841']) }}">支持</a></li>
                </ul>
                <!-- /Links -->
            </div>
            <div class="col-md-4">
                <!-- Newsletter Form -->
                <h4 class="letter-spacing-1">订阅我们</h4>
                <p>订阅我们的最新消息以获取重要新闻</p>
                <form class="validate" action="{{ route(SITE . 'StoreSubscription') }}" method="post" novalidate="novalidate">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                        <input type="email" id="email" name="email" class="form-control required" placeholder="请输入邮箱">
                        <span class="input-group-btn"><button class="btn btn-success" type="submit">订阅</button></span>
                    </div>
                    <div class="ajax-form-alert">

                    </div>
                </form>
                <!-- /Newsletter Form -->
                <!-- Social Icons -->
                <div class="mt-20">
                    <a href="https://www.facebook.com/intellisn" class="social-icon social-icon-border social-facebook float-left" target="_blank" data-toggle="tooltip" data-placement="top" title="" data-original-title="Facebook">
                        <i class="icon-facebook"></i>
                        <i class="icon-facebook"></i>
                    </a>
                    <a href="https://twitter.com/intellisn" class="social-icon social-icon-border social-twitter float-left" target="_blank" data-toggle="tooltip" data-placement="top" title="" data-original-title="Twitter">
                        <i class="icon-twitter"></i>
                        <i class="icon-twitter"></i>
                    </a>
                </div>
                <!-- /Social Icons -->
            </div>
        @else

        @endif
    </div>
</div>
<div class="copyright">
    <div class="container">
        {{--<ul class="float-right m-0 list-inline mobile-block">--}}
        {{--<li><a href="#">Terms &amp; Conditions</a></li>--}}
        {{--<li>•</li>--}}
        {{--<li><a href="#">Privacy</a></li>--}}
        {{--</ul>--}}
        © All Rights Reserved, Intellisn Corporation.
    </div>
</div>
