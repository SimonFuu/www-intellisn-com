<body>
<p>Dear {{ $order -> recipient }},</p>
<p>We have received your payment (Order Number: <b>{{ $order -> id }}</b>, Amount: <b>{{ $order -> amount }}</b>).</p>
<p>The order is being processed and you will be notified when the status changes.</p>
<p>You can also search the order details here with your order number and related email address.</p>
<p>{{ route(SITE . 'OrderInquiryForm') }}</p>
<p>If you have any other questions, please feel free to contact us.</p>
<p>{{ route(SITE . 'Contact') }}</p>
<p>Regards,</p>
<p>The Intellisn Team</p>
</body>