@extends('layouts.common')
@section('main')
    <!-- -->
    <section>
        <div class="container">

            <!-- CHECKOUT FINAL MESSAGE -->
            <div class="card card-default">
                <div class="card-block">
                    <h3>Thank you, John Doe.</h3>

                    <p>
                        Your order has been placed. In a few moments you will receive an order confirmation email from us.<br />
                        If you like, you can explore more <a href="{{ route(SITE . 'Index') }}">smarty products</a>.
                    </p>

                    <hr />

                    <p>
                        Thank you very much for choosing us,<br />
                        <strong>Smarty Inc.</strong>
                    </p>
                </div>
            </div>
            <!-- /CHECKOUT FINAL MESSAGE -->

        </div>
    </section>
    <!-- / -->
@endsection