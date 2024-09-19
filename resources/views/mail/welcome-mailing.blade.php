<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang='eng'>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ env('APP_NAME') }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"
        defer>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
        defer>
    <style>
        body {
            font-family: "Inter", sans-serif;
            font-optical-sizing: auto;
        }

        pre {
            font-size: 1rem;
            font-family: "Inter", sans-serif;
            font-optical-sizing: auto;
        }
    </style>
</head>


<body>
    <center>
        <table style="margin-top:1rem; width: 30rem">
            <tbody>
                <tr>
                    <td>Welcome <span style="font-weight: 600"> {{ $recipient }}</span>!</td>
                </tr>
                <tr>
                    <td>
                        <h4>Thank you so much for joining us <3</h4>
                        <pre>
At Fresh2GoHub we hope to bring the wholesale needs of Trinidad much more
convenient, quality assured and approachable. When we say 'lets get you something to eat'
We're not kidding!
</pre>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p>Stay tuned for deals, updates and more @fresh2GoHub</p>
                    </td>
                </tr>
            </tbody>
        </table>
    </center>
</body>

</html>
