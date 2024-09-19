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
        tbody > tr > td:first-child{
            width: 8rem;
        }
    </style>
</head>

<body>
    <center>
        <table style="margin-top: 1rem">
            <table style="width: 30rem">
                <tbody>
                    <tr>
                        <td>
                            Order made: {{ $order->created_at }}
                        </td>
                    </tr>
                    <tr>
                        <th
                            style="display:block; text-align: start; background-color:rgb(202, 231, 160); border-radius:10px; padding:.5rem">
                            <h3 style="margin:0"><span style="font-weight: 500">Order:</span> {{ $order->ticket }} <i
                                    class="bi bi-receipt"></i>
                            </h3>
                        </th>
                    </tr>
                </tbody>
            </table>
            <table style="width: 30rem; margin-top:1rem">
                <tbody style="display: block; text-align:start">
                    <tr>
                        <td>Name: </td>
                        <td >{{ $order->name }}</td>  
                    </tr>
                    <tr>
                        <td>Contact:</td>
                        <td>{{ $order->contact }}</td>
                    </tr>
                    <tr>
                        <td>Area:</td>
                        <td>{{ $order->area }}</td>
                    </tr>
                    <tr>
                        <td>Address:</td>
                        <td>{{ $order->address }}</td>
                    </tr>
                    <tr>
                        <td>Instructions:</td>
                        <td>{{ $order->instructions }}</td>
                    </tr>
                    <tr>
                        <td>Via:</td>
                        <td>{{ $order->via }}</td>
                    </tr>
                    <tr>
                        <td>Status:</td>
                        <td style="{{ $order->status == 'unpaid' ? 'color:red' : 'color:green' }}">
                            {{ $order->status }}</td>
                    </tr>
                </tbody>
            </table>
            <table style="width: 30rem">
                <tbody>
                    <tr>
                        <th style="width: 10rem">Name</th>
                        <th style="width: 10rem">Option</th>
                        <th style="width: 10rem">Metric</th>
                        <th style="width: 10rem">Quantity</th>
                        <th style="width: 10rem">Value</th>
                        <th style="width: 10rem">Sum</td>
                    </tr>
                    @foreach ($order->transactions as $transaction)
                        <tr>
                            <td style="overflow-wrap:break-word">{{ $transaction->product->name }}</td>
                            <td>{{ $transaction->option }}</td>
                            <td>/ {{ $transaction->metric }}</td>
                            <td>{{ $transaction->quantity }}</td>
                            <td>${{ number_format($transaction->value, 2, '.', '') }}</td>
                            <td>${{ number_format($transaction->value * $transaction->quantity, 2, '.', '') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <table style="width: 30rem; margin-top:1rem">
                <tbody>
                    <tr>
                        <td>
                            <h5>Total: ${{ number_format($order->total, 2, '.', '') }}</h4>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p style="font-size:.8rem ;margin:0;line-height:1">If there are any issues with the details of your order please feel free to contact us <br> via the website help section</p>
                        </td>
                    </tr>
                </tbody>
            </table>
        </table>
    </center>
</body>

</html>
