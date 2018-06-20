@extends('backend.layouts')
@section('main')
    <section>
        <div class="container">
            <p class="mb-10">Order ID: <b>{{ $order -> id }}</b></p>
            <p class="mb-10">Delivery information: <b>{{ $order -> address }}</b></p>
            <p class="mb-10">Create time: <b>{{ $order -> create_at }}</b></p>
            <div class="row">

                <div class="col-md-6">

                    {!! Form::open(['url' => route('backendSubmitSetShipment', ['id' => $order -> id]), 'method' => 'post', 'class' => 'form-horizontal', 'role' => 'form']) !!}
                        <!-- class include {'form-horizontal'|'form-inline'} -->
                        <input type="hidden" name="oId" value="{{ $order -> id }}">
                        <!--- Company Field --->
                        <div class="form-group">
                            {!! Form::label('cId', 'Express Company:', ['class' => 'control-label']) !!}
                            {!! Form::select('cId', $expressCompanies, null, ['class' => 'form-control']) !!}
                        </div>
                        <!--- Number Field --->
                        <div class="form-group">
                            {!! Form::label('number', 'Number:', ['class' => 'control-label']) !!}
                            {!! Form::text('number', null, ['class' => 'form-control', 'max' => 255, 'placeholder' => '多个运单号，请用半角";"分割']) !!}
                        </div>
                        <button class="btn btn-primary" type="submit">Submit</button>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>


    </section>
@endsection