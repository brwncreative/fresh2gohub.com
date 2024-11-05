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
                    <td>Welcome <span style="font-weight: 600"> {{ $recipient }}</span></td>
                </tr>
                <tr>
                    <td>
                        <h4>Thank you so much for joining us!</h4>
                        <p>
                            All of us at Fresh2GoHub.com are happy to have you and hope to share some great things in
                            the coming future.
                        </p>
                    </td>
                </tr>
                <tr><td><hr></td></tr>
                <tr>
                    <td>
                        <h6 style="font-weight: 600">About Us</h6>
                        <p>Fresh2GoHub is your destination for premium prepped foods that bring flavor, convenience, and quality to
                            your kitchen. We specialize in a curated selection of freshly prepped fruits, vegetables,
                            meats, salts, and marinades, designed to elevate your culinary experience with ease and
                            excellence.
                            At Fresh2Go Hub, we believe that great food starts with the freshest ingredients. That’s why
                            we carefully source each product and prepare it with attention to detail, ensuring that you
                            can enjoy quick and delicious meals without compromising on quality. Whether you’re a busy
                            professional, a home cook, or a food enthusiast, our goal is to provide you with ingredients
                            that help you create wholesome, tasty meals in no time.
                            We’re dedicated to making meal prep simple and sustainable by offering portioned, prepped
                            ingredients that cut down on food waste and cooking time. Thank you for choosing Fresh2Go
                            Hub – where freshness and flavor are always within reach.</p>
                    </td>
                </tr>
                <tr><td><hr></td></tr>
                <tr>
                    <td>
                        <p>We'll be sure to update you soon, in the meantime check us out on social media @fresh2GoHub
                        </p>
                    </td>
                </tr>
            </tbody>
        </table>
    </center>
</body>

</html>
