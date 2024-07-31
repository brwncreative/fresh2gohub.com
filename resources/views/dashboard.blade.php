<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>{{ config('app.name') }}</title>
    {{-- Favicon --}}
    <link rel="icon" type="svg" href="{{ App\Http\Controllers\FileController::serveImageFile('favicon', 'svg') }}">

    <!-- Fonts and CSS-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"
        defer>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
        defer>

    {{-- Vite assets from production --}}
    @vite(['resources/js/app.js','resources/css/app.css'])
</head>

<body class="inter-font">
    <header>
        <nav id="dashboard-nav">
            <div id="dashboard-logo" class="center">
                <a href="{{ route('dashboard') }}">
                    <picture>
                        <img src="{{ App\Http\Controllers\FileController::serveImageFile('fresh2go_logo', 'svg') }}"
                            height="55px" width="auto" fetchpriority="high" loading="eager"
                            alt="Fresh2Go Logo"></img>
                    </picture>
                </a>
            </div>
            <div id="dashboard-actions" class="center">
                <div class="action"><a href="{{route('/')}}"><i class="bi bi-box-arrow-right"></i>Logout</div></a>
                <div class="action"><i class="bi bi-people"></i>Switch User</div>
                <div class="action"><i class="bi bi-telephone"></i>Contact Dev</div>
            </div>
            <div id="dashboard-menu" class="center">@livewire('dashboard.dashboard-menu', ['menu_items' => ['products', 'mailing-list', 'users']])</div>
        </nav>
    </header>
    <main id="dashboard-content">
        <div></div>
        @if (request()->is('dashboard/products'))
            @livewire('dashboard.dashboard-products')
        @endif
        @if (request()->is('dashboard/mailing-list'))
            @livewire('dashboard.dashboard-mailing')
        @endif
    </main>
</body>

</html>
