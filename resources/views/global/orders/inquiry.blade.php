@extends('layouts.common')
@section('main')
    <section>
        <div class="container">

            <div class="row">

                <div class="col-md-6 offset-md-3">
                    @if(!$result)
                        <div class="alert alert-danger mt-30 mb-30"><!-- DANGER -->
                            <strong>Error</strong> {{ $message }}
                        </div>
                    @endif
                    <div class="box-static box-border-top p-30">
                        <form class="m-0" method="get" action="#" autocomplete="off">
                            <div class="clearfix">
                                <!-- Email -->
                                <div class="form-group">
                                    <input type="email" name="email" class="form-control" placeholder="Email" required="">
                                </div>
                                <!-- Order number -->
                                <div class="form-group">
                                    <input type="text" name="order_number" class="form-control" placeholder="Order number" required="">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12 text-right">
                                    <button class="btn btn-primary">SEARCH</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection