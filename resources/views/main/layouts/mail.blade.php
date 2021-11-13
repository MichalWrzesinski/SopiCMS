<!DOCTYPE html>

<html lang="pl-PL">
    <head>
        <meta charset="utf-8">
        <style>
            body {

                margin: 0;
                padding: 0;

                font: 17px sans-serif;
                line-height: 1.5em;
                font-weight: 300;
            }

            #wrapper {

                padding: 50px;

                color: #111;
                background: #f5f5f5;
            }

            #message {

                max-width: 700px;
                margin: 0 auto;
                padding: 30px;

                background: #fff;
                border: 1px solid #ccc;
            }

            h1 {

                margin: 0;
                padding: 0;

                font-size: 26px;
            }

            hr {

                margin: 30px 0;
                height: 1px;

                border: 0;
                background: #ccc;
            }

            p {

                margin: 0;
            }

            a {

                color: #e10055;
            }

            a:hover {

                color: #e10055;
            }

            .button {

                display: inline-block;
                margin: 0 5px 0 0;
                padding: 0 20px;
                height: 2.7em;

                background: #09b294;
                color: #fff !important;
                font: 17px sans-serif;
                line-height: 2.7em;
                font-weight: 600;
                text-decoration: none !important;
                border-radius: 2px;
            }

            .button:hover {

                background: #e10055;
                color: #fff !important;
            }
        </style>
    </head>
    <body>
        <div id="wrapper">
            <div id="message">
                <h1>{{ $subject }}</h1>
                <hr>
                {!!  $body !!}
                <hr>
                @isset($url)
                    <p><a href="{{ $url }}" class="button">{{ isset($button) ? $button : $url }}</a></p>
                    <hr>
                @endisset
                @if(isset($name) OR isset($email) OR isset($phone))
                    <p>
                        @isset($name)Nadawca: {{ $name }}<br>@endisset
                        @isset($email))E-mail: {{ $email }}<br>@endisset
                        @isset($phone))Telefon: {{ $phone }}<br>@endisset
                    </p>
                    <hr>
                @endif
                <p>Pozdrawiamy!<br><strong>{{ config('sopicms.siteName') }}</strong></p><br>
                <p><a href="{{ env('APP_URL') }}">{{ env('APP_URL') }}</a></p>
            </div>
        </div>
    </body>
</html>
