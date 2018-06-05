@extends('layouts.common')
@section('main')
    <section class="contact-intellisn-section">
        <div class="container">
            <p>
                Intellisn, a group of dreamers creating excellent products for people's daily life. We are a team of engineers but also enthusiastic designers who focus on details with unique understanding of user experience.
            </p>
            <p>
                Any questions, please contact us by emailing to <a href="mailto:contact@intellisn.com">contact@intellisn.com</a>. We will answer all your questions and do our best to help you.
            </p>

            <p>
                In addition, social media is also an important place for us to publish product information, future plans and promotional activities. Follow us to make sure you don't miss out on any valuable information.
            </p>
            <p>
                Facebook <br />
                <a href="https://www.facebook.com/intellisn" target="_blank">https://www.facebook.com/intellisn</a>
            </p>
            <p>
                Twitter<br />
                <a href="https://www.twitter.com/intellisn" target="_blank">https://www.twitter.com/intellisn</a>
            </p>
            <p>
                You can also get information about an order you placed on the Intellisn Online Store through the Order Inquiry page.<br />
                <a href="{{ route(SITE. 'OrderInquiryForm') }}">{{ route(SITE. 'OrderInquiryForm') }}</a>
            </p>
            <p>
                Thank you very much.
            </p>
        </div>
    </section>

@endsection