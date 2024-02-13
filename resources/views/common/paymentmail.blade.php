
@component('mail::message')
<p>Dear {{ $vendorName }},</p>

<p>Congratulations! You have successfully subscribed to the "{{ $packageName }}" package on Wedding Bells.</p>

<p>Package Details:</p>
<ul>
    <li>Image Count: {{ $imageCount }}</li>
    <li>Ads Count: {{ $adsCount }}</li>
    <li>Top Ads Count: {{ $topAdsCount }}</li>
</ul>

<p>Thank you for choosing joing with us. We help you to take your buisness to next Level</p>

<p><strong>Subscription Details:</strong></p>
<ul>
    <li><strong>Bought Date:</strong> {{ $boughtDate }}</li>
    <li><strong>Expire Date:</strong> {{ $expirationDate }}</li>
</ul>

@component('mail::button', ['url' => 'http://wedding-bells-4.0.test/login'])
Visit Your Dashboard
@endcomponent
@endcomponent


