@extends('layouts.common')
@section('main')
    <div class="container">
        
        <!-- CHECKOUT -->
        <form class="row clearfix" method="post" action="#">

            <div class="col-lg-7 col-sm-7">
                <!-- SHIPPING -->
                <fieldset id="shipping" class="mt-80">
                    <h4>Shipping Address</h4>
                    <hr />

                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <label for="shipping:firstname">First Name *</label>
                            <input id="shipping:firstname" name="shipping[firstname]" type="text" class="form-control required" />
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <label for="shipping:lastname">Last Name *</label>
                            <input id="shipping:lastname" name="shipping[lastname]" type="text" class="form-control required" />
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <label for="shipping:email">Email *</label>
                            <input id="shipping:email" name="shipping[email]" type="text" class="form-control required" />
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <label for="shipping:phone">Phone *</label>
                            <input id="shipping:phone" name="shipping[phone]" type="text" class="form-control required" />
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <label for="shipping:address1">Address *</label>
                            <input id="shipping:address1" name="shipping[address][]" type="text" class="form-control required" placeholder="Address 1" />

                            <input id="shipping:address2" name="shipping[address][]" type="text" class="form-control mt-10" placeholder="Address 2" />
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <label for="shipping:city">City *</label>
                            <input id="shipping:city" name="shipping[city]" type="text" class="form-control required" />
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <label for="shipping:state">State/Province *</label>
                            <select id="shipping:state" name="shipping[state]" class="form-control pointer required">
                                <option value="">Select...</option>
                                <option value="1">Alabama</option>
                                <option value="2">Alaska</option>
                                <option value="">..............</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <label for="shipping:zipcode">Zip/Postal Code *</label>
                            <input id="shipping:zipcode" name="shipping[zipcode]" type="text" class="form-control required" />
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <label for="shipping:country">Country *</label>
                            <select id="shipping:country" name="shipping[country]" class="form-control pointer required">
                                <option value="">Select...</option>
                                <option value="1">united States</option>
                                <option value="2">united Kingdom</option>
                                <option value="">..............</option>
                            </select>
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
                                        <label for="payment:name">Name on Card *</label>
                                        <input id="payment:name" name="payment[name]" type="text" class="form-control required" autocomplete="off" />
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12">
                                        <label for="payment:cc_number">Credit Card Number *</label>
                                        <input id="payment:cc_number" name="payment[cc_number]" type="text" class="form-control required" autocomplete="off" />
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12">
                                        <label for="payment:cc_exp_month">Card Expiration *</label>

                                        <div class="row mb-0">
                                            <div class="col-lg-6 col-sm-6">
                                                <select id="payment:cc_exp_month" name="payment[cc_exp_month]" class="form-control pointer required">
                                                    <option value="0">Month</option>
                                                    <option value="01">01 - January</option>
                                                    <option value="02">02 - February</option>
                                                    <option value="03">03 - March</option>
                                                    <option value="04">04 - April</option>
                                                    <option value="05">05 - May</option>
                                                    <option value="06">06 - June</option>
                                                    <option value="07">07 - July</option>
                                                    <option value="08">08 - August</option>
                                                    <option value="09">09 - September</option>
                                                    <option value="10">10 - October</option>
                                                    <option value="11">11 - November</option>
                                                    <option value="12">12 - December</option>
                                                </select>
                                            </div>

                                            <div class="col-lg-6 col-sm-6">
                                                <select id="payment:cc_exp_year" name="payment[cc_exp_year]" class="form-control pointer required">
                                                    <option value="0">Year</option>
                                                    <option value="2015">2015</option>
                                                    <option value="2016">2016</option>
                                                    <option value="2017">2017</option>
                                                    <option value="2018">2018</option>
                                                    <option value="2019">2019</option>
                                                    <option value="2020">2020</option>
                                                    <option value="2021">2021</option>
                                                    <option value="2022">2022</option>
                                                    <option value="2023">2023</option>
                                                    <option value="2024">2024</option>
                                                    <option value="2025">2025</option>
                                                </select>
                                            </div>

                                        </div>

                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12">
                                        <label for="payment:cc_cvv">CVV2 *</label>
                                        <input id="payment:cc_cvv" name="payment[cc_cvv]" type="text" class="form-control required" autocomplete="off" maxlength="4" />
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                </fieldset>
                <!-- /CREDIT CARD PAYMENT -->


                <!-- TOTAL / PLACE ORDER -->
                <div class="toggle-transparent toggle-bordered-full clearfix">
                    <div class="toggle active">
                        <div class="toggle-content">

                                            <span class="clearfix">
                                                <span class="float-right">$120.75</span>
                                                <strong class="float-left">Subtotal:</strong>
                                            </span>
                            <span class="clearfix">
                                                <span class="float-right">$0.00</span>
                                                <span class="float-left">Discount:</span>
                                            </span>
                            <span class="clearfix">
                                                <span class="float-right">$8.00</span>
                                                <span class="float-left">Shipping:</span>
                                            </span>

                            <hr />

                            <span class="clearfix">
                                                <span class="float-right fs-20">$128.75</span>
                                                <strong class="float-left">TOTAL:</strong>
                                            </span>

                            <hr />

                            <button class="btn btn-primary btn-lg btn-block fs-15"><i class="fa fa-mail-forward"></i> Place Order Now</button>
                        </div>
                    </div>
                </div>
                <!-- /TOTAL / PLACE ORDER -->


            </div>
        </form>
        <!-- /CHECKOUT -->
    </div>
@endsection