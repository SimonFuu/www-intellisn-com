@extends('layouts.common')
@section('main')
    <section>
        <div class="container">
            <div class="row">
                <!-- IMAGE -->
                <div class="col-lg-4 col-sm-4">
                    <div class="thumbnail relative mb-3">
                        
                        <figure id="zoom-primary" class="zoom" data-mode="mouseover">
                            <a class="lightbox bottom-right" href={{ CDN_SERVER }}"/images/smarty/shop/products/1000x1500/p5.jpg" data-plugin-options='{"type":"image"}'><i class="fa fa-search"></i></a>
                            <img class="img-fluid" src={{ CDN_SERVER }}"/images/smarty/shop/products/1000x1500/p5.jpg" width="1200" height="1500" alt="This is the product title" />
                        </figure>
                    </div>
                    <!-- Thumbnails (required height:100px) -->
                    <div data-for="zoom-primary" class="zoom-more owl-carousel owl-padding-3 featured" data-plugin-options='{"singleItem": false, "autoPlay": false, "navigation": true, "pagination": false}'>
                        <a class="thumbnail active" href={{ CDN_SERVER }}"/images/smarty/shop/products/1000x1500/p5.jpg">
                            <img src={{ CDN_SERVER }}"/images/smarty/shop/products/100x100/p5.jpg" height="100" alt="" />
                        </a>
                        <a class="thumbnail" href={{ CDN_SERVER }}"/images/smarty/shop/products/1000x1500/p6.jpg">
                            <img src={{ CDN_SERVER }}"/images/smarty/shop/products/100x100/p6.jpg" height="100" alt="" />
                        </a>
                        <a class="thumbnail" href={{ CDN_SERVER }}"/images/smarty/shop/products/1000x1500/p7.jpg">
                            <img src={{ CDN_SERVER }}"/images/smarty/shop/products/100x100/p7.jpg" height="100" alt="" />
                        </a>
                        <a class="thumbnail" href={{ CDN_SERVER }}"/images/smarty/shop/products/1000x1500/p8.jpg">
                            <img src={{ CDN_SERVER }}"/images/smarty/shop/products/100x100/p8.jpg" height="100" alt="" />
                        </a>
                        <a class="thumbnail" href={{ CDN_SERVER }}"/images/smarty/shop/products/1000x1500/p9.jpg">
                            <img src={{ CDN_SERVER }}"/images/smarty/shop/products/100x100/p9.jpg" height="100" alt="" />
                        </a>
                        <a class="thumbnail" href={{ CDN_SERVER }}"/images/smarty/shop/products/1000x1500/p10.jpg">
                            <img src={{ CDN_SERVER }}"/images/smarty/shop/products/100x100/p10.jpg" height="100" alt="" />
                        </a>
                        <a class="thumbnail" href={{ CDN_SERVER }}"/images/smarty/shop/products/1000x1500/p11.jpg">
                            <img src={{ CDN_SERVER }}"/images/smarty/shop/products/100x100/p11.jpg" height="100" alt="" />
                        </a>
                    </div>
                    <!-- /Thumbnails -->
                </div>
                <!-- /IMAGE -->
                <!-- ITEM DESC -->
                <div class="col-lg-5 col-sm-8">

                    <!-- /buttons -->
                    <!-- price -->
                    <div class="shop-item-price">
                        <span class="line-through pl-0">$98.00</span>
                        $78.00
                    </div>
                    <!-- /price -->
                    <hr />
                    <!-- short description -->
                    <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                    <!-- /short description -->

                    <hr />
                    <div class="product-options">
                        <div class="product-option-1">
                            <div class="product-option inline-block" data-sku="1" data-value="黑胡桃">
                                黑胡桃
                            </div>
                            <div class="product-option inline-block">
                                花梨
                            </div>
                        </div>

                        <button data-url="{{ route(SITE . 'ShoppingCart') }}" class="add-to-cart-btn btn btn-primary">ADD TO CART</button>
                    </div>

                    <hr />



                </div>
                <!-- /ITEM DESC -->

                <!-- INFO -->
                <div class="col-sm-4 col-md-3">

                    <h4 class="fs-18">
                        <i class="fa fa-paper-plane-o"></i>
                        FREE SHIPPING
                    </h4>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas metus nulla.</p>

                    <h4 class="fs-18">
                        <i class="fa fa-clock-o"></i>
                        30 DAYS MONEY BACK
                    </h4>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas metus nulla.</p>

                    <h4 class="fs-18">
                        <i class="fa fa-users"></i>
                        CUSTOMER SUPPORT
                    </h4>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas metus nulla.</p>

                    <hr>

                    <p class="fs-11">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas metus nulla, commodo a sodales sed, dignissim pretium nunc. Nam et lacus neque.
                    </p>
                </div>
                <!-- /INFO -->

            </div>



            <ul id="myTab" class="nav nav-tabs nav-top-border mt-80" role="tablist">
                <li class="nav-item"><a class="nav-link active" href="#description" data-toggle="tab">Description</a></li>
                <li class="nav-item"><a class="nav-link" href="#specs" data-toggle="tab">Specifications</a></li>
            </ul>


            <div class="tab-content pt-20">

                <!-- DESCRIPTION -->
                <div role="tabpanel" class="tab-pane active" id="description">
                    <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Aliquam fermentum commodo magna, id pretium nisi elementum at. Nulla molestie, ligula in fringilla rhoncus, risus leo dictum est, nec egestas nunc sem tincidunt turpis. Sed posuere consectetur est at lobortis.</p>
                    <p>Donec blandit ultrices condimentum. Aliquam fermentum commodo magna, id pretium nisi elementum at. Nulla molestie, ligula in fringilla rhoncus, risus leo dictum est, nec egestas nunc sem tincidunt turpis. Sed posuere consectetur est at lobortis.</p>
                </div>

                <!-- SPECIFICATIONS -->
                <div role="tabpanel" class="tab-pane fade" id="specs">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>Column name</th>
                                <th>Column name</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>Size</td>
                                <td>2XL</td>
                            </tr>
                            <tr>
                                <td>Color</td>
                                <td>Red</td>
                            </tr>
                            <tr>
                                <td>Weight</td>
                                <td>132lbs</td>
                            </tr>
                            <tr>
                                <td>Height</td>
                                <td>74cm</td>
                            </tr>
                            <tr>
                                <td>Bluetooth</td>
                                <td><i class="fa fa-check text-success"></i> YES</td>
                            </tr>
                            <tr>
                                <td>Wi-Fi</td>
                                <td><i class="fa fa-remove text-danger"></i> NO</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection