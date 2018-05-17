<div class="container">
    <div class="row">
        <div class="col-md-4">
            <!-- Footer Logo -->
            <img class="footer-logo" src="{{ CDN_SERVER }}/images/logo-footer.png" alt="">
            <!-- Small Description -->
            <p>Integer posuere erat a ante venenatis dapibus posuere velit aliquet.</p>
            <!-- Contact Address -->
            <div>
                <ul class="list-unstyled">
                    <li class="">
                        PO Box 21132<br>
                        Here Weare St, Melbourne<br>
                        Vivas 2355 Australia<br>
                    </li>
                    <li class="">
                        Phone: 1-800-565-2390
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
            <h4 class="letter-spacing-1">Links</h4>
            <ul class="list-unstyled">
                <li><a href="{{ route(SITE . 'Index') }}">Home</a></li>
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
            <form class="validate" action="#" method="post" data-success="Subscribed! Thank you!" data-toastr-position="bottom-right" novalidate="novalidate">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                    <input type="email" id="email" name="email" class="form-control required" placeholder="Enter your Email">
                    <span class="input-group-btn">
                    <button class="btn btn-success" type="submit">Subscribe</button>
                </span>
                </div>
                <input type="hidden" name="is_ajax" value="true">
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
    </div>
</div>
<div class="copyright">
    <div class="container">
        {{--<ul class="float-right m-0 list-inline mobile-block">--}}
        {{--<li><a href="#">Terms &amp; Conditions</a></li>--}}
        {{--<li>•</li>--}}
        {{--<li><a href="#">Privacy</a></li>--}}
        {{--</ul>--}}
        © All Rights Reserved, Intellisn Corporation. 蜀ICP备123456789 （FROM DB）
    </div>
</div>

