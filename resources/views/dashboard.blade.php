<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>{{ config('app.name') }}</title>
    {{-- Favicon --}}
    <link rel="icon" type="ico" href="{{ App\Http\Controllers\FileController::serveImageFile('favicon', 'ico') }}">

    <!-- Fonts and CSS-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"
        defer>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
        defer>

    {{-- Vite assets from production --}}
    @vite(['resources/js/app.js', 'resources/css/app.css'])
</head>

<body class="inter-font">
    <header>
        <nav id="dashboard-nav">

            <div id="dashboard-actions" class="center">
                <div class="action"><a href="{{ route('/') }}"><i class="bi bi-box-arrow-right"></i>Logout</div></a>
                <div class="action"><i class="bi bi-people"></i>Switch User</div>
                <div class="action"><i class="bi bi-telephone"></i>Contact Dev</div>
                <div class="action"><a href="{{ route('dashboard') }}"><i class="bi bi-house"></i></i>Home</a></div>
            </div>
            <div id="dashboard-menu" class="center">@livewire('dashboard.dashboard-menu', ['menu_items' => ['products', 'mailing-list', 'users']])</div>
        </nav>
    </header>
    <main id="dashboard-content">
        <div></div>
        @if (request()->is('dashboard'))
            <div id="dashboard-welcome" class="center">
                <div id="dw-content" class="center">
                    <h1>
                        <strong>Welcome</strong>
                        to your dashboard
                    </h1>
                    <p>Edit and add products, interact with your mailing list and manage the users of Fresh2GoHub
                </div>
            </div>
        @endif
        @if (request()->is('dashboard/products'))
            @livewire('dashboard.dashboard-products')
        @endif
        @if (request()->is('dashboard/mailing-list'))
            @livewire('dashboard.dashboard-mailing')
        @endif
    </main>
</body>

</html>
