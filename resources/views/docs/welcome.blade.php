<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name') }} - API - {{ config('app.version') }}</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <div class="content">
                <div class="title m-b-md">
                    {{ config('app.name') }} Documentation
                </div>
                <div class="postman-run-button"
                     data-postman-action="collection/import"
                     data-postman-var-1="de562630d6c6b9da94b8"></div>
                <script type="text/javascript">
                    (function (p,o,s,t,m,a,n) {
                        !p[s] && (p[s] = function () { (p[t] || (p[t] = [])).push(arguments); });
                        !o.getElementById(s+t) && o.getElementsByTagName("head")[0].appendChild((
                            (n = o.createElement("script")),
                                (n.id = s+t), (n.async = 1), (n.src = m), n
                        ));
                    }(window, document, "_pm", "PostmanRunObject", "https://run.pstmn.io/button.js"));
                </script>
                <div class="links">
                    <a href="{{ config('app.website_url') }}">Website</a>
                    <a href="{{ config('app.github_url') }}">GitHub</a>
                </div>
            </div>
        </div>
    </body>
</html>
