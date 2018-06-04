@extends('layouts.common')
@section('main')
    <section>
        <div class="container">
            <div class="row">
                <!-- IMAGE -->
                <div class="col-lg-4 col-sm-4">
                    <div class="thumbnail relative mb-3">
                        
                        <figure id="zoom-primary" class="zoom" data-mode="mouseover">
                            <a class="lightbox bottom-right" href="{{ CDN_SERVER . $product -> thumb  }}" data-plugin-options='{"type":"image"}'><i class="fa fa-search"></i></a>
                            <img class="img-fluid" src="{{ CDN_SERVER . $product -> thumb  }}" width="1200" height="1500" alt="This is the product title" />
                        </figure>
                    </div>
                    @if($product -> thumbs)
                        <!-- Thumbnails (required height:100px) -->
                        <div data-for="zoom-primary" class="zoom-more owl-carousel owl-padding-3 featured" data-plugin-options='{"singleItem": false, "autoPlay": false, "navigation": true, "pagination": false}'>
                            @foreach($product -> thumbs as $key => $thumb)
                                <a class="thumbnail {{ $key == 0 ? 'active' : '' }}" href="{{ CDN_SERVER . $thumb -> value  }}">
                                    <img src="{{ CDN_SERVER . $thumb -> value }}" height="100" alt="" />
                                </a>
                            @endforeach
                        </div>
                        <!-- /Thumbnails -->
                    @endif

                </div>
                <!-- /IMAGE -->
                <!-- ITEM DESC -->
                <div class="col-lg-5 col-sm-8">
                    <!-- /buttons -->
                    <!-- price -->
                    <div class="shop-item-price">
                        <span class="product-original-price pl-0">
                            {{ $product -> price -> currency . ': ' . $product -> price -> cur_symbol . number_format($product -> price -> price / 100, 2) }}
                        </span>
                        <br>
                        <span class="product-price"></span>
                    </div>
                    <hr />
                    <!-- /price -->
                    <div class="product-id clearfix mb-30" data-product-id="{{ $product-> id }}">
                        <strong>ITLS ID: </strong> {{ $product -> id }}
                    </div>
                    <!-- short description -->
                    <p>{{ $product ->abstract }}</p>
                    <!-- /short description -->

                    <hr />
                    <div class="product-options">
                        @if($product -> options)
                            @php($i = 1)
                            @foreach($product -> options as $group => $options)
                                <div class="product-option-group product-option-{{ $i }}">

                                    <span>
                                        {{ $group }}
                                    </span>
                                    @foreach($options as $option)
                                        <div class="product-option inline-block" data-opt-id="{{ $option -> id }}" data-thumb="{{ $option -> thumb }}" data-value="{{ $option -> name }}" data-query-url="{{ route(SITE. 'QuerySKUPrice') }}">
                                            {{ $option -> name }}
                                        </div>
                                    @endforeach
                                    @php($i++)
                                    {{--<div class="product-option inline-block">--}}
                                        {{--花梨--}}
                                    {{--</div>--}}
                                </div>

                            @endforeach

                        @endif
                        <button data-url="{{ route(SITE . 'AddingToShoppingCart') }}" class="add-to-cart-btn btn btn-primary">ADD TO CART</button>
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
                @if($product -> spu)
                    <li class="nav-item"><a class="nav-link" href="#specs" data-toggle="tab">Specifications</a></li>
                @endif
            </ul>


            <div class="tab-content pt-20">

                <!-- DESCRIPTION -->
                <div role="tabpanel" class="tab-pane active" id="description">
                    {{ $product -> descritpion  }}
                </div>

                @if($product -> spu)
                    <!-- SPECIFICATIONS -->
                    <div role="tabpanel" class="tab-pane fade" id="specs">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <tbody>
                                    @foreach($product -> spu as $spu)
                                        <tr>
                                            <td>{{ $spu -> name }}</td>
                                            <td>{{ $spu -> value }}</td>
                                        </tr>
                                    @endforeach
                                    {{--<tr>--}}
                                        {{--<td>Bluetooth</td>--}}
                                        {{--<td><i class="fa fa-check text-success"></i> YES</td>--}}
                                    {{--</tr>--}}
                                    {{--<tr>--}}
                                        {{--<td>Wi-Fi</td>--}}
                                        {{--<td><i class="fa fa-remove text-danger"></i> NO</td>--}}
                                    {{--</tr>--}}
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>
@endsection