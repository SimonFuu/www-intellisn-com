@extends('layouts.common')
@section('main')
<section>
    <div class="container">
        <!-- EMPTY CART -->
        <div class="card card-default">
            <div class="card-block">
                <strong>Shopping cart is empty!</strong><br />
                You have no items in your shopping cart.<br />
                Click <a href="{{ route(SITE . 'Index') }}">here</a> to continue shopping. <br />
            </div>
        </div>
        <!-- /EMPTY CART -->

        <!-- CART -->
        <div class="row">
            <!-- LEFT -->
            <div class="col-lg-9">
                <!-- CART -->
                <table class="table nomargin cart-content">
                    <thead>
                    <tr>
                        <td width="50%">PRODUCT NAME</td>
                        <td width="25%">QUANTITY</td>
                        <td width="25%">TOTAL</td>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>
                            <div class="cart_img float-left fw-100 p-10 text-left"><img src={{ CDN_SERVER }}"/images/smarty/shop/products/100x100/p13.jpg" alt="" width="80" /></div>
                            <a href="" class="product_name">
                                <span>Pink Lady Perfect Shoes</span>
                                <br>
                                <small>Color: Pink, Size: 6.5</small>
                            </a>
                        </td>
                        <td>
                            <div class="qty form-inline"><input class="form-control" type="number" value="1" name="qty" maxlength="2" max="99" min="1" /> &times; $67.19</div>
                        </td>
                        <td>
                            <span>$67.19</span>
                        </td>
                    </tr>
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
                                {!! Form::select('country', $countries, $location, ['class' => 'cart-delivery-country form-control select2']) !!}
                            </div>

                        </div>

                        <div class="toggle-content" style="display: block;">
                            <span class="clearfix">
                                <span class="float-right total-budget"><span>$0</span></span>
                                <strong class="float-left">Subtotal:</strong>
                            </span>
                            <span class="clearfix">
                                <span class="float-right discount">$0.00</span>
                                <span class="float-left">Discount:</span>
                            </span>
                            <span class="clearfix">
                                <span class="float-right shipping">$0.00</span>
                                <span class="float-left">Shipping:</span>
                            </span>
                            <hr>
                            <span class="clearfix">
                                <span class="float-right fs-20 pay-amount"><strong>$0</strong></span>
                                <strong class="float-left">TOTAL:</strong>
                            </span>
                            <hr>
                            <a href="{{ route(SITE . 'CheckoutForm') }}" class="btn btn-primary btn-lg btn-block fs-15">
                                <strong><i class="fa fa-mail-forward"></i> Checkout</strong>
                            </a>
                        </div>
                    </div>

                </div>
                <!-- /TOGGLE -->

            </div>

        </div>
        <!-- /CART -->

    </div>
</section>
@endsection