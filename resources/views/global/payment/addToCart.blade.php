@extends('layouts.common')
@section('main')
    <section class="add-to-cart-result" data-items-count="{{ $cartItemsCount }}">
        <div class="container">
            @if($result)
                <div class="alert alert-success margin-bottom-30"><!-- ERROR -->
                    <strong>Success!</strong> {{ $message }}
                </div>
            @else
                <div class="alert alert-danger margin-bottom-30"><!-- ERROR -->
                    <strong>Error!</strong> {{ $message }}
                </div>
            @endif
        </div>
    </section>
@endsection
