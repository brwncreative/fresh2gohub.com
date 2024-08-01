<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="Shop at Fresh2GoHub; Fruits, Veggies, Sauces and more! It's all Fresh2Go." />
    <meta name="robots" content="index, follow" />

    <title>{{ config('app.name') }}</title>
    {{-- Favicon --}}
    <link rel="icon" type="ico"
        href="{{ App\Http\Controllers\FileController::serveImageFile('favicon', 'ico') }}">

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
    {{-- Navigation --}}
    <header>
        <nav id="main-nav">
            <div id="panel" class="nav-element"></div>
            <div id="panel2" class="nav-element"></div>
            {{-- Quick Links --}}
            <div id="links" class="nav-element">
                <a href="/" class="nav-link">About</a>
                <a href="/" class="nav-link">Contact</a>
                <a href="/" class="nav-link">More</a>
                <a href="/" class="nav-link">Terms and Conditions</a>
            </div>
            {{-- Logo --}}
            <div id="logo" class="nav-element">
                <a href="{{ route('/') }}">
                    <picture>
                        <img src="{{ App\Http\Controllers\FileController::serveImageFile('fresh2go_logo', 'svg') }}"
                            height="55px" width="auto" fetchpriority="high" loading="eager"
                            alt="Fresh2Go Logo"></img>
                    </picture>
                </a>
                <div id="l-divider"></div>
            </div>
            {{-- Search Bar --}}
            <div id="search" class="nav-element"> @livewire('nav.searchbar') </div>
            {{-- Tool kit --}}
            <div id="actions" class="nav-element">
                <div id="a-delivery" class="action">
                    <strong>Delivery</strong>
                    <p>Set Address</p>
                </div>
                <div id="a-account" class="action">
                    <strong>Account Area</strong>
                    <a href="{{ route('login') }}">
                        <p>Login / Sign up</p>
                    </a>
                </div>
                <div id="a-coupons" class="action"><i class="bi bi-ticket h2"></i></div>
                <div id="a-cart" class="action"><i class="bi bi-basket h2"></i>
                    <p>0</p>
                </div>
                <div id="a-options"><i class="bi bi-list"></i></div>
            </div>
            {{-- Menu --}}
            <menu id="menu" class="nav-element center">
                @livewire('nav.menu', ['menuItems' => ['mixed packages', 'vegetables', 'prepackaged fruit and platters','mash','sauces', 'seasonings','dry rubs(packs)','meats', 'seafood','marinades']])
            </menu>
            {{-- Filters --}}
            <div id="filters" class="nav-element">
                <label>Shop by:</label>
                @livewire('nav.tags', ['tags' => ['healthy', 'snack', 'express', 'delivery', 'popular'], 'style' => 'display:flex; justify-content:center; align-items:center; margin-inline:.2rem; background-color:rgb(245, 245, 245); width:auto; height:35px; border-radius:20px; padding-inline:1rem; border:1px solid rgb(139, 139, 139); font-size:.9rem'])
            </div>
        </nav>
    </header>
    <main>
        <div id="push"></div>
        <div id="content" class="center">
            <section id="hero" class="center section">
                @livewire('main.carousel', ['title' => $title])
            </section>
            <div class="divider"></div>
            <section id="aboutus" class="section center">
                @livewire('main.section', ['heading' => 'Why choose Fresh2Go?', 'text' => "When you're passionate about something, ideas tend to expand and eventually become the sparks for action. We at Fresh2GoHub believe in better ingredients, better food and the best quality to go"])
            </section>
            <div class="divider"></div>
        </div>
    </main>

    <footer>
        <x-footer></x-footer>
    </footer>
</body>

</html>
