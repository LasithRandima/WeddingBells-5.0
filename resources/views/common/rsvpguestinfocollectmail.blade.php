<style>
        .logo{
                    width: 100% !important;
                }

        .logo img {
            max-width: 220px !important;
            width: 200px;
            height: auto;
            margin-top: 20px;
            margin-bottom: 20px;
            margin-left: auto;
            margin-right: auto;
            display: block;
        }
</style>


@component('mail::message')
<div class="logo">
    <img src="https://res.cloudinary.com/de32z3ml9/image/upload/v1704858029/WB_logo_12_rqxi7n.png" alt="Website Logo" >
</div>
<div>
    {!! $rsvprequestmsg !!}

</div>
@component('mail::button', ['url' => $rsvprequestlink])
Visit WeddingBells
@endcomponent
@endcomponent

{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wedding Invitation</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f5f5f5;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
            margin-top: 20px;
        }

        h1, p {
            text-align: center;
        }

        .invitation-details {
            margin-top: 20px;
        }

        .cta-button {
            display: inline-block;
            margin-top: 20px;
            background-color: #9012f1;
            color: #fff;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 5px;
        }

        .cta-button:hover {
            background-color: #b85dfd;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Your Wedding Invitation</h1>
        <p>We are excited to invite you to our wedding celebration!</p>

        <div class="invitation-details">
            <p><strong>Date:</strong> [Wedding Date]</p>
            <p><strong>Time:</strong> [Wedding Time]</p>
            <p><strong>Location:</strong> [Venue Name, City]</p>
        </div>

        <p>We hope you can join us on this special day to share the joy and happiness.</p>

        <p>RSVP by [RSVP Deadline] and let us know if you can make it!</p>

        <div style="text-align: center;">
            <a class="cta-button" href="[RSVP Link]">RSVP Now</a>
        </div>
    </div>
</body>
</html> --}}

