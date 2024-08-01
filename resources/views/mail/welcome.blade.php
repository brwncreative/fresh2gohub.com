<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml"
    xmlns:o="urn:schemas-microsoft-com:office:office">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>{{ config('app.name') }} Welcome Mail</title>
    <style>
        h1,
        h2,
        h3,
        h4 {
            padding: 0;
            margin: 0
        }

        p {
            padding: 0;
            margin: 0
        }

        .inter-font {
            font-family: "Inter", sans-serif;
            font-optical-sizing: auto;
            font-weight: 400;
            font-style: normal;
        }
        .spacer{
            height: 10px;
        }
    </style>
</head>

<body class="inter-font">
    <div id="main" style="width: 100%;">
        <table style="width: 100%;">
            <tr>
                <td align="center">
                    <table style="width: 90%">
                        <tr>
                            <td>
                                <table style="width: 100%">
                                    <tr style="background-color: #fff">
                                        <td align="center">
                                            <picture>
                                                <img src={{ App\Http\Controllers\FileController::serveImageFile('fresh2go_logo', 'png') }}
                                                    height="55px" width="auto" title="Fresh2GoHub Logo"
                                                    alt="Fresh2Go Logo" style="display:block"></img>
                                            </picture>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td class="spacer"></td>
                        </tr>
                        <tr>
                            <td>
                                <table style="width: 100%">
                                    <tr>
                                        <td>
                                            <p style="width:20px; display: inline-block;">Hi</p>
                                            <h3 style="width:300px; display: inline-block; font-size:16px; font-weight:600">{{ $recipient }}</h3>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td class="spacer"></td>
                        </tr>
                        <tr>
                            <td class="spacer"></td>
                        </tr>
                        <tr>
                            <td>
                                <table style="width: 100%">
                                    <tr>
                                        <td>
                                            <h1> Thank you for joining our mailing list</h1>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p style=display: inline-block;"> We aim to impress with our wide selection
                                                of items, item
                                                quality and efficient delivery.
                                                Stay tuned and
                                                you'll
                                                get
                                                all the need to know right here in your email!</p>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
    </div>
</body>

</html>
