@extends('layouts.common')
@section('main')
    <!-- -->
    <section>
        <div class="container">
            @if(session('success'))
            <!-- CHECKOUT FINAL MESSAGE -->
            <div class="card card-default">
                <div class="card-block">
                    <h3>Thank you, {{ session('success') }}.</h3>

                    <p>
                        Your order has been placed. In a few moments you will receive an order confirmation email from us.<br />
                        If you like, you can explore more <a href="{{ route(SITE . 'Index') }}">Intellisn products</a>.
                    </p>

                    <hr />

                    <p>
                        Thank you very much for choosing us,<br />
                        <strong>Intellisn Corporation.</strong>
                    </p>
                </div>
            </div>
            <!-- /CHECKOUT FINAL MESSAGE -->
            @endif
        </div>
    </section>
    <!-- / -->
@endsection