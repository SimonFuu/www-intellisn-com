<body>
<p>Dear {{ $order -> recipient }},</p>
<p>We have initiated the shipment(Carrier: <a href="{{ $order -> shipment -> website }}">{{ $order -> shipment -> company }}</a>, Tracking Number: <b>{{ $order -> shipment -> number }}</b> for your order <b>{{ $order -> id }}</b>.</p>
<p>You can track your order on the carrier’s website by clicking the link above.</p>
<p>If you have any other questions, please feel free to contact us.</p>
<p><a href="{{ route('globalContact') }}">{{ route('globalContact') }}</a></p>
<p>Regards,</p>
<p>The Intellisn Team</p>
</body>

