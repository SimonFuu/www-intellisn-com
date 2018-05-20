@extends('layouts.common')
@section('main')
    <section>
        <div class="container">
            <div class="order-detail">
                <div class="order-detail-header">
                    <div>
                        <strong>E-mail：</strong> <span>Simon Fu</span>
                    </div>
                    <div>
                        <strong>Intellisn order number:</strong> <span>123456</span>
                    </div>
                    <div>
                        <strong>Order total:</strong> <span>$100</span>
                    </div>
                    <div>
                        <strong>Order status:</strong> <strong class="text-danger">SHIPPED</strong>
                    </div>
                    <div>
                        <strong>Shipping trace number:</strong> <span><a href="http://www.baidu.com">UPS</a> - 123456</span>
                    </div>
                    <hr class="mt-10">
                    <div>
                        <strong>Order time:</strong> <span>{{ date('Y-m-d H:i:s') }}</span>
                    </div>
                    <div>
                        <strong>Last update time:</strong> <span>{{ date('Y-m-d H:i:s') }}</span>
                    </div>
                </div>
                <div class="order-detail-info">
                    <table class="table table-bordered table-condensed">
                        <tbody>
                        <tr>
                            <td rowspan="4" width="150" class="order-recipient">
                                <div><strong>Recipient:</strong></div>
                                <div>null</div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h4>Item(s) Ordered</h4>
                                <table class="ordered-items">
                                    <tbody>
                                        <tr>
                                            <td width="50">
                                                <img src={{ CDN_SERVER }}"/images/smarty/shop/products/100x100/p13.jpg" alt="Thumb" width="50">
                                            </td>
                                            <td><span>DomiLamp</span><br><small>American WALNUT</small></td>
                                            <td>x 5</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-right order-detail-payment-detail">
                                <div>Item(s) Subtotal: <span class="order-detail-payment-amount">$660.00</span></div>
                                <div>Discount: <span class="order-detail-payment-amount">-$250.00</span></div>
                                <div>Shipping: <span class="order-detail-payment-amount">$90.00</span></div>
                                <div>----------------------------------</div>
                                <div class="order-detail-payment-total">Grand Total: <span class="text-danger order-detail-payment-amount">$500</span></div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div><strong>Delivery Address:</strong></div>
                                null
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

@endsection