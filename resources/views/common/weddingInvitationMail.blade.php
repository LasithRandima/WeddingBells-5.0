{{-- @component('mail::message')

<div>
    {!! $rsvprequestmsg !!}
</div>
@component('mail::button', ['url' => $rsvprequestlink])
Visit WeddingBells
@endcomponent
@endcomponent --}}

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wedding Invitation</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            text-align: center;
            margin: 0;
            padding: 0;
            background-color: #C8A2C8 ;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border: 1px solid #EFEAF4;
        }
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
        .couple-name {
            color: #2B2B2B;
            font-size: 32px;
            font-weight: bold;
            margin-bottom: 10px;
        }
        .wedding-date {
            color: #2B2B2B;
            font-size: 17px;
            margin-bottom: 10px;
        }
        .image{
            width: 100%;
        }
        .image img {
            max-width: 300px !important;
            width: 280px;
            height: auto;
            margin-top: 20px;
            margin-bottom: 20px;
            margin-left: auto;
            margin-right: auto;
            display: block;
        }
        .invite-msg {
            font-size: 14px;
            margin-top: 50px;
            margin-bottom: 20px;
        }
        .rsvp-button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #4e2a8e;
            color: #ffffff;
            text-decoration: none;
            font-size: 18px;
            border-radius: 5px;
            margin-top: 30px;
            margin-bottom: 40px;
        }
        .heart-emojis {
            font-size: 20px;
            margin-top: 30px;
            margin-bottom: 20px;
        }
        .small-font {
            font-size: 16px;
            margin-bottom: 20px;
        }

        .footer {
            margin-top: 30px;
            background-color: #6A0DAD;
            padding: 20px;
            border-radius: 0 0 10px 10px;
            color: #ffffff;
        }

        .flexwrapper{
            margin: 10px 0px;
            padding: 20px 0px;
            width: 100% !important;
        }

        .social-icons {
            /* display: flex;
            justify-content: center;
            justify-items: center;
            gap: 20px; */
            width: 220px;
            margin-left: auto;
            margin-right: auto;
            display: block;
        }

        .social-icons img {
            width: 30px; /* Adjust the size as needed */
            height: 30px;
            margin-right: 20px;
        }


    </style>
</head>
<body>
    <div class="container">
        <div class="logo">
            <img src="https://res.cloudinary.com/de32z3ml9/image/upload/v1704858029/WB_logo_12_rqxi7n.png" alt="Website Logo" >
        </div>
        <div class="couple-name">
            {{ ucwords($client_name) }} & {{ ucwords($partner_name) }}
        </div>
        <div class="wedding-date">
             {{ $wedding_date }}
        </div>
        <div class="image">
            <img src="https://ci3.googleusercontent.com/meips/ADKq_NaHO4fgViiexclyzhAI9BnL0XAh3D4aNvEcYpbfPEQW6cIxWMNSxzbAJptz_3pMkAYEE1fhpVzMO6-5BxeVC3WetoWOr1uIDk9UCRBWRmB_2n8=s0-d-e1-ft#https://cdn1.hitched.co.uk/img/mail/requestConfirm-en_GB.gif" alt="Wedding Image">
        </div>
        <div class="invite-msg">
            {{ $inviteMsg }}
        </div>
        <a href="{{ $rsvplink }}" class="rsvp-button">RSVP</a>
        <div class="heart-emojis">
            ❤️❤️❤️
        </div>
        <div class="small-font">
            Thank you
        </div>
        <div class="small-font">
            {{ ucwords($client_name) }} & {{ ucwords($partner_name) }}
        </div>

        <hr style="border-top: 1px solid #EFEAF4; margin: 20px 0;">

        <div class="footer">

            <div class="flexwrapper">
                <div class="social-icons">
                    <a href="https://www.facebook.com/pages/weddingbells/" target="_blank"><img src="https://ci3.googleusercontent.com/meips/ADKq_NYYnod2hkZkSvnDIl6DO-iqxoWTsUBSvaojoB-8dF5klomehxXcgslAeZpc4R3L3crb_y6M9BleAZ-D6oy-_A306JpDC4d8fDXQMsviHrc=s0-d-e1-ft#https://cdn1.hitched.co.uk/assets/img/social/facebook.png" alt="Facebook"></a>
                    <a href="https://www.twitter.com/pages/weddingbells/" target="_blank"><img src="https://ci3.googleusercontent.com/meips/ADKq_Nb3cz9lKFybUFZuuwxdt3UtWRdgrHjaJAtygqo9jLZ2BqaRP0AfopdCS5XrgVoCdvL_OJsdMDJW88_QYqBfK_lK6-hW23NJkRyZiCKHqw=s0-d-e1-ft#https://cdn1.hitched.co.uk/assets/img/social/twitter.png" alt="Twitter"></a>
                    <a href="https://www.pinterest.com/" target="_blank"><img src="https://ci3.googleusercontent.com/meips/ADKq_NZBx83U2FQl08xxXrn2K7m2tDyh6msHTWWTz-EsWX9MzURR7TDo7dnEAJo0T0eXqrf-U1q58z_9LastumqPvEsjzv10D9lIuz5AeYcyDTpc=s0-d-e1-ft#https://cdn1.hitched.co.uk/assets/img/social/pinterest.png" alt="Pinterst"></a>
                    <a href="https://www.instagram.com/pages/weddingbells/" target="_blank"><img src="https://ci3.googleusercontent.com/meips/ADKq_NZ8S6jredNyftOsBURB3BFBHOZp2G5_fuK2rsIiyUygaDFV7cwGQgJrU-OblaypvEkLg8VVBt2AqGd5I10bOHO233nghO7v0pFZzCO-R6yC=s0-d-e1-ft#https://cdn1.hitched.co.uk/assets/img/social/instagram.png" alt="Instagram"></a>
                </div>
            </div>

            <p>
                Copyright © 2023 Wedding Bells. All Rights Reserved.
            </p>
        </div>
    </div>
</body>
</html>
