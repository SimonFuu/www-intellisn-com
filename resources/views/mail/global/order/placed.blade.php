<body>
订单：{{ $order -> id }} <br>
收件人：{{ $order -> recipient }} <br>
追踪地址：{{ route(SITE . 'OrderInquiryForm') }}
</body>