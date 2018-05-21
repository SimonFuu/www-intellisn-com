@extends('layouts.common')
@section('main')
<section>
    <div class="container">
        @if(isset($items))
            <form action="{{ route(SITE . 'CheckoutForm') }}" method="post">
                <!-- CART -->
                <div class="row">
                    <!-- LEFT -->
                    <div class="col-lg-9">
                        <!-- CART -->
                        <table class="table nomargin cart-content">
                            <thead>
                            <tr>
                                <td width="40%">PRODUCT NAME</td>
                                <td width="25%">QUANTITY</td>
                                <td width="20%">TOTAL</td>
                                <td class="text-center" width="15%">ACTION</td>
                            </tr>
                            </thead>
                            <tbody class="">
                                @foreach($items as $sku => $item)
                                    <tr>
                                        <td>
                                            <div class="cart_img float-left fw-100 p-10 text-left">
                                                <img src={{ CDN_SERVER }}"/images/smarty/shop/products/100x100/p13.jpg" alt="" width="80" />
                                            </div>
                                            <a href="{{ route(SITE . 'Product', ['id' => $item -> product_id]) }}" class="product_name">
                                                <span>{{ $item -> product }}</span>
                                                <br>
                                                <small>{{ $item -> sku_name }}</small>
                                            </a>
                                        </td>
                                        <td>
                                            <div class="qty form-inline">
                                                <input class="item-count text-center" data-sku="{{ $sku }}" data-update-url="{{ route(SITE . 'UpdatingToShoppingCart', ['sku' => $sku]) }}" type="number" value="{{ $item -> count }}" name="qty" maxlength="2" max="99" min="1" /> &times;
                                                {{ $item -> cur_symbol .  number_format($item -> price / 100, 2) }}
                                            </div>
                                        </td>
                                        <td>
                                            {{ $item -> cur_symbol }}<span class="item-price">{{ number_format($item -> price * $item -> count / 100, 2) }}</span>
                                        </td>
                                        <td class="text-center">
                                            <span class="cart-delete-item" data-update-url="{{ route(SITE . 'UpdatingToShoppingCart', ['sku' => $sku]) }}"><i class="fa fa-times"></i></span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <!-- /CART -->

                    </div>


                    <!-- RIGHT -->
                    <div class="col-lg-3">

                        <!-- TOGGLE -->
                        <div class="toggle-transparent toggle-bordered-full clearfix">

                            <div class="toggle active">
                                <div class="delivery-country">
                                    <!--- Country Field --->
                                    <div class="form-group">
                                        {!! Form::label('country', 'Delivery Country / Region', ['class' => 'form-control-label']) !!}
                                        {!! Form::select('country', $countries, $location, ['class' => 'cart-delivery-country form-control select2', 'data-update-url' => route(SITE . 'UpdatingShoppingCartDelivery')]) !!}
                                    </div>

                                </div>

                                <div class="toggle-content" style="display: block;">
                                <span class="clearfix">
                                    <span class="float-right total-budget">{{ $price['cur_symbol'] }}<span>{{ number_format($price['subtotal'] / 100, 2) }}</span></span>
                                    <strong class="float-left">Subtotal:</strong>
                                </span>
                                    <span class="clearfix">
                                    <span class="float-right discount line-through">{{ $price['cur_symbol'] }}<span>{{ number_format($price['discount'] / 100, 2) }}</span></span>
                                    <span class="float-left">Discount:</span>
                                </span>
                                    <span class="clearfix">
                                    <span class="float-right shipping">{{ $price['cur_symbol'] }}<span>{{ number_format($price['shipping'] / 100, 2) }}</span></span>
                                    <span class="float-left">Shipping:</span>
                                </span>
                                    <hr>
                                    <span class="clearfix">
                                    <span class="float-right fs-20 pay-amount"><strong>{{ $price['cur_symbol'] }}<span>{{ number_format($price['total'] / 100, 2) }}</span></strong></span>
                                    <strong class="float-left">TOTAL:</strong>
                                </span>
                                    <hr>
                                    <button class="btn btn-primary btn-lg btn-block fs-15">
                                        <strong><i class="fa fa-mail-forward"></i> Checkout</strong>
                                    </button>
                                </div>
                            </div>

                        </div>
                        <!-- /TOGGLE -->

                    </div>
                </div>
                <!-- /CART -->
            </form>
        @endif
        <!-- EMPTY CART -->
        <div class="card card-default {{ isset($items) ? 'hide-cart-default' : ''}}">
            <div class="card-block">
                <strong>Shopping cart is empty!</strong><br />
                You have no items in your shopping cart.<br />
                Click <a href="{{ route(SITE . 'Index') }}">here</a> to continue shopping. <br />
            </div>
        </div>
        <!-- /EMPTY CART -->

    </div>
</section>
@endsection