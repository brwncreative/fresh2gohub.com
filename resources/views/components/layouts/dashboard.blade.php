<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ env('APP_NAME') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" defer>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
        defer>
    @vite(['resources/css/dashboard/dashboard.css', 'resources/css/app.css'])
</head>

<body>
    <header>
        <nav id="dashboard-nav">
            <div id="id-actions">
                <a href="{{ route('dashboard') }}">
                    <p class="small-title">Hi <span class="bold">{{ Auth::user()->name }}</span></p>
                </a>
                <a href="{{ route('welcome') }}">Site Home</a>
                <a href="{{ route('logout') }}">
                    <i class="bi bi-box-arrow-left h3"></i>
                </a>
            </div>
            <div id="menu">
                <x-helpers.dashboard.menu :items="['products', 'orders', 'users', 'whatsapp']"></x-helpers.dashboard.menu>
            </div>
        </nav>
    </header>
    {{ $slot }}
</body>

</html>
