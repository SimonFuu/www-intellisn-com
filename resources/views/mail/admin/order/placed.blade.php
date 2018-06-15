<body>
<p>
    Dear administrator,
</p>
<p>
    We have received a payment (Order Number: <b>{{ $order -> id }}</b>, Amount: <b>{{ $order -> amount }}</b>).
</p>
<hr>
<p>
    Recipient: <b>{{ $order -> recipient }}</b>
</p>
<p>
    Delivery address: <b>{{ $order -> address }}</b>
</p>
<p>
    Ordered items:
</p>
@foreach($order -> detail as $item)
    <p>
        <b>
            【{{ $item -> product }}】 - 【{{ $item -> sku }}】 x 【{{ $item -> quantity }}】
        </b>
    </p>
@endforeach
</body>