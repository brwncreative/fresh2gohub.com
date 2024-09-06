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
    @vite(['resources/css/checkout/cart.css','resources/css/results/results.css','resources/css/products/products.css', 'resources/css/helpers.css', 'resources/js/app.js', 'resources/css/app.css', 'resources/css/navigation/standard-nav.css', 'resources/css/welcome/welcome.css', 'resources/css/sections/explore.css'])
</head>

<body>
    <header>
        <nav id="standard-nav">
            <section id="nav-links">
                <a href=""><small>About</small></a>
                <a href=""><small>Contact</small></a>
                <a href=""><small>More</small></a>
                <a href=""><small>Terms and Conditions</small></a>
                <a href=""><small>Delivery</small></a>
            </section>
            <section id="nav-main">
                <div id="logo">
                    <a href="{{route('welcome')}}"> <img src="{{ App\Http\Controllers\MediaController::serveImage('logo', 'svg') }}"
                            height="50px" width="auto" fetchpriority="high" loading="eager"
                            alt="Fresh2Go Logo"></img>
                    </a>
                    <div class="v-divider"></div>
                </div>
                <div id="searchbar"><livewire:utilities.search-bar></livewire:utilities.search-bar></div>
                <div id="actions">
                    @auth
                        <div><a href=""><i class="bi bi-truck h3"></i></a></div>
                    @endauth
                    @guest
                        <div><a href="{{ route('login') }}"><i class="bi bi-person h3"></i></a></div>
                    @endguest
                    @auth
                        <div class="auth-greeting"><span class="paragraph">Hi</span>
                            <span><small>{{ isset(Auth::user()->name) ? Auth::user()->name : Auth::user()->email }}</small></span>
                        </div>
                    @endauth
                    <div><a href="{{route('orders')}}"><i class="bi bi-receipt h3"></i></a></div>
                    <div>@livewire('cart.cart')</div>
                    {{-- Mobile Conditional --}}
                    <div><a href=""><i class="bi bi-list h3"></i></a></div>
                </div>
                <div id="menu"><x-helpers.menu :items="[
                    'mixed packages',
                    'vegetables',
                    'prepackaged fruit and platters',
                    'mash',
                    'sauces',
                    'seasonings',
                    'dry rubs(packs)',
                    'meats',
                    'seafood',
                    'marinades',
                ]"> </x-helpers.menu></div>
            </section>
            <section id="nav-shopby">
                <x-helpers.shop-by :items="['Healthy', 'Popular', 'Diwali']">
                </x-helpers.shop-by>
            </section>
        </nav>
    </header>
    {{ $slot }}
    <footer>

    </footer>
</body>

</html>
