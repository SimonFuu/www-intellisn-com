@extends('layouts.common')
@section('main')
    <section>
        <div class="container">
            <div class="order-detail">
                <div class="order-detail-header">
                    <div>
                        <strong>E-mail：</strong> <span>{{ $order -> email }}</span>
                    </div>
                    <div>
                        <strong>Intellisn order number:</strong> <span>{{ $order -> id }}</span>
                    </div>
                    <div>
                        <strong>Order total:</strong> <span>{{ $order -> cur_symbol . number_format($order -> total / 100, 2) }}</span>
                    </div>
                    @if($order -> status == 0)
                        <div>
                            <strong>Order status:</strong> <strong class="text-yellow">{{ config('app.order.status.' . $order -> status) }}</strong>
                        </div>
                    @elseif($order -> status == 1)
                        <div>
                            <strong>Order status:</strong> <strong class="text-blue">{{ config('app.order.status.' . $order -> status) }}</strong>
                        </div>
                    @elseif($order -> status == 2)
                        <div>
                            <strong>Order status:</strong> <strong class="text-green">{{ config('app.order.status.' . $order -> status) }}</strong>
                        </div>
                        <div>
                            <strong>Shipping trace number:</strong> <span>
                                <a href="{{ $order -> express -> website }}">{{ $order -> express -> name }}</a> - {{ $order -> express -> number }}
                            </span>
                        </div>
                    @else

                    @endif
                    <hr class="mt-10">
                    <div>
                        <strong>Order time:</strong> <span>{{ $order -> create_at }}</span>
                    </div>
                    <div>
                        <strong>Last update time:</strong> <span>
                            {{ $order -> express ? $order -> express -> update_at : $order -> create_at }}
                        </span>
                    </div>
                </div>
                <div class="order-detail-info">
                    <table class="table table-bordered table-condensed">
                        <tbody>
                        <tr>
                            <td rowspan="4" width="150" class="order-recipient">
                                <div><strong>Recipient:</strong></div>
                                <div> {{ $order -> recipient }} </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h4>Item(s) Ordered</h4>
                                <table class="ordered-items">
                                    <tbody>
                                        @foreach($order -> detail as $item)
                                                <tr>
                                                    <td width="50">
                                                        <img src="{{ CDN_SERVER . $item -> thumb }}" alt="Thumb" width="50">
                                                    </td>
                                                    <td><span>{{ $item -> product }}</span><br><small>{{ $item -> sku }}</small></td>
                                                    <td>x {{ $item -> quantity }}</td>
                                                </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-right order-detail-payment-detail">
                                <div>Item(s) Subtotal: <span class="order-detail-payment-amount">{{ $order -> cur_symbol . number_format($order -> subtotal / 100, 2) }}</span></div>
                                <div>Discount: <span class="order-detail-payment-amount">-{{ $order -> cur_symbol . number_format($order -> discount / 100, 2) }}</span></div>
                                <div>Shipping: <span class="order-detail-payment-amount">{{ $order -> cur_symbol . number_format($order -> shipping / 100, 2) }}</span></div>
                                <div>----------------------------------</div>
                                <div class="order-detail-payment-total">Grand Total:
                                    <span class="text-danger order-detail-payment-amount">
                                        {{ $order -> cur_symbol . number_format($order -> total / 100, 2) }}
                                    </span>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div><strong>Delivery Address:</strong></div>
                                {{ $order -> address }}
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

@endsection