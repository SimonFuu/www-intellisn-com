@extends('layouts.common')
@section('main')
    <div class="container">
        @if(session('error'))
            <div class="alert alert-danger mt-30"><!-- DANGER -->
                <strong>Error</strong> {{ session('error') }}
                <br />
                Please try again.
            </div>
        @endif
        <form action="{{ route(SITE . 'ReCheckout') }}" method="post">
            {{ csrf_field() }}
            <input type="hidden" name="id" value="{{ $order -> id }}">
            <div class="row">
                <div class="col-lg-7 col-sm-7">
                    <!-- SHIPPING -->
                    <fieldset id="shipping" class="mt-30">
                        <h4>Shipping Address</h4>
                        <hr />

                        <div class="row form-row">
                            <div class="col-md-6 col-sm-6 form-group">
                                <label for="name">Name *</label>
                                <input id="name" name="name" value="{{ $delivery -> name }}" type="text" class="form-control required{{ $errors -> has('name') ? ' is-invalid error' : '' }}" />
                                @if($errors -> has('name'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors -> first('name') }}</strong>
                                    </div>
                                @endif
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <label for="email">Email *</label>
                                <input id="email" name="email" value="{{ $delivery -> email }}" type="text" class="form-control required{{ $errors -> has('email') ? ' is-invalid error' : '' }}" />
                                @if($errors -> has('email'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors -> first('email') }}</strong>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 col-sm-6">
                                <label for="phone">Phone *</label>
                                <input id="phone" name="phone" value="{{ $delivery -> phone }}" type="text" class="form-control required{{ $errors -> has('phone') ? ' is-invalid error' : '' }}" />
                                @if($errors -> has('phone'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors -> first('phone') }}</strong>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <label for="address1">Address *</label>
                                <input id="address1" name="address1" value="{{ $delivery -> address1 }}" type="text" class="form-control required{{ $errors -> has('address1') ? ' is-invalid error' : '' }}" placeholder="Address 1" />
                                @if($errors -> has('address1'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors -> first('address1') }}</strong>
                                    </div>
                                @endif
                                <input id="address2" name="address2" value="{{ $delivery -> address2 }}" type="text" class="form-control mt-10{{ $errors -> has('address2') ? ' is-invalid error' : '' }}" placeholder="Address 2" />
                                @if($errors -> has('address2'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors -> first('address2') }}</strong>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 col-sm-6">
                                <label for="city">City *</label>
                                <input id="city" name="city" value="{{ $delivery -> city }}" type="text" class="form-control required{{ $errors -> has('city') ? ' is-invalid error' : '' }}" />
                                @if($errors -> has('city'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors -> first('city') }}</strong>
                                    </div>
                                @endif
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <label for="state">State/Province *</label>
                                <input id="state" name="state" value="{{ $delivery -> state }}" type="text" class="form-control required{{ $errors -> has('state') ? ' is-invalid error' : '' }}" />
                                @if($errors -> has('state'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors -> first('state') }}</strong>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 col-sm-6">
                                <label for="zip">Zip/Postal Code *</label>
                                <input id="zip" name="zip" value="{{ $delivery -> zip }}" type="text" class="form-control required{{ $errors -> has('zip') ? ' is-invalid error' : '' }}" />
                                @if($errors -> has('zip'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors -> first('zip') }}</strong>
                                    </div>
                                @endif
                            </div>
                            <div class="col-md-6 col-sm-6">
                                {!! Form::label('country', 'Country *', []) !!}
                                {!! Form::select('country', [$order -> car => $delivery -> country], $order -> car, ['class' => 'form-control pointer required select2 disabled' . ($errors -> has('country') ? ' is-invalid error' : '')]) !!}
                                @if($errors -> has('country'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors -> first('country') }}</strong>
                                    </div>
                                @endif
                            </div>

                        </div>
                    </fieldset>
                    <!-- /SHIPPING -->

                </div>

                <div class="col-lg-5 col-sm-5">
                    <!-- CREDIT CARD PAYMENT -->
                    <fieldset id="ccPayment" class="mt-30">
                        <div class="toggle-transparent toggle-bordered-full clearfix">
                            <div class="toggle active">
                                <div class="toggle-content">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <label for="paymentCCName">Name on Card *</label>
                                            <input id="paymentCCName" name="paymentCCName" type="text" class="form-control required{{ $errors -> has('paymentCCName') ? ' is-invalid error' : '' }}" autocomplete="off" />
                                            @if($errors -> has('paymentCCName'))
                                                <div class="invalid-feedback">
                                                    <strong>{{ $errors -> first('paymentCCName') }}</strong>
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-12">
                                            <label for="paymentCCNumber">Credit Card Number *</label>
                                            <input id="paymentCCNumber" name="paymentCCNumber" type="text" class="form-control required{{ $errors -> has('paymentCCNumber') ? ' is-invalid error' : '' }}" autocomplete="off" />
                                            @if($errors -> has('paymentCCNumber'))
                                                <div class="invalid-feedback">
                                                    <strong>{{ $errors -> first('paymentCCNumber') }}</strong>
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-12">
                                            <label for="paymentCCExpMonth">Card Expiration *</label>
                                            <div class="row mb-0">
                                                <div class="col-lg-6 col-sm-6">
                                                    {!! Form::select('paymentCCExpMonth', $ccExpMonths, null, ['class' => 'form-control pointer required' . ($errors -> has('paymentCCExpMonth') ? ' is-invalid error' : '')]) !!}
                                                    @if($errors -> has('paymentCCExpMonth'))
                                                        <div class="invalid-feedback">
                                                            <strong>{{ $errors -> first('paymentCCExpMonth') }}</strong>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="col-md-6 col-sm-6">
                                                    {!! Form::select('paymentCCExpYear', $ccExpYears, null, ['class' => 'form-control pointer required' . ($errors -> has('paymentCCExpYear') ? ' is-invalid error' : '')]) !!}
                                                    @if($errors -> has('paymentCCExpYear'))
                                                        <div class="invalid-feedback">
                                                            <strong>{{ $errors -> first('paymentCCExpYear') }}</strong>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-12">
                                            <label for="paymentCCCVV">CVV2 *</label>
                                            <input id="paymentCCCVV" name="paymentCCCVV" type="text" class="form-control required{{ $errors -> has('paymentCCCVV') ? ' is-invalid error' : '' }}" autocomplete="off" maxlength="4" />
                                            @if($errors -> has('paymentCCCVV'))
                                                <div class="invalid-feedback">
                                                    <strong>{{ $errors -> first('paymentCCCVV') }}</strong>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <span class="clearfix">
                                    <span class="float-right fs-20">{{ $order -> cur_symbol . number_format($order -> total / 100, 2)}}</span>
                                    <strong class="float-left">TOTAL:</strong>
                                </span>
                                    <hr />
                                    <button class="btn btn-primary btn-lg btn-block fs-15"><i class="fa fa-mail-forward"></i> Place Order Now</button>
                                </div>
                            </div>
                        </div>

                    </fieldset>
                    <!-- /CREDIT CARD PAYMENT -->

                </div>
            </div>

        </form>
    </div>
@endsection