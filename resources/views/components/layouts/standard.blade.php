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
    @vite(['resources/css/ad-space/ad-space.css', 'resources/css/login/login.css', 'resources/css/checkout/cart.css', 'resources/css/results/results.css', 'resources/css/products/products.css', 'resources/css/helpers.css', 'resources/js/app.js', 'resources/css/app.css', 'resources/css/navigation/standard-nav.css', 'resources/css/welcome/welcome.css', 'resources/css/sections/sections.css'])
    <link rel="icon" type="image/x-icon"
        href="{{ App\Http\Controllers\MediaController::serveImage('favicon', 'ico') }}">
</head>

<body>
    <header>
        {{-- Navigation container --}}
        <nav id="standard-nav">
            <div class="bucket">
                <section id="nav-links">
                    <a href="{{ route('about') }}">About</a>
                    <a href="{{ route('contact') }}">Contact</a>
                    <a href="{{ route('more') }}">More</a>
                    <a href="{{ route('terms-and-conditions') }}">Terms and Conditions</a>
                    <a href="{{ route('delivery') }}">Delivery</a>
                </section>
                <section class="main-controls">
                    {{-- Logo --}}
                    <div id="logo" class="control center">
                        <a href="{{ route('welcome') }}"> <img
                                src="{{ App\Http\Controllers\MediaController::serveImage('logo', 'svg') }}"
                                height="50px" width="auto" fetchpriority="high" loading="eager"
                                alt="Fresh2Go Logo"></img>
                        </a>
                        <div class="v-divider"></div>
                    </div>
                    {{-- SearchBar --}}
                    <div id="searchbar" class="control center">
                        <livewire:utilities.search-bar></livewire:utilities.search-bar>
                    </div>
                    {{-- Actions --}}
                    <div id="actions" class="control center">
                        @guest
                            <div>
                                <livewire:utilities.login :key="'mobile'" :type="'icon'" :how="'icon'">
                                </livewire:utilities.login>
                            </div>
                        @endguest
                        @auth
                            <div><a href=""><i class="bi bi-truck h4"></i></a></div>
                            <div class="auth-greeting">
                                <a href="{{ Auth::user()->role != 'guest' ? route('dashboard') : route('logout') }}">
                                    <span class="paragraph">Hi</span>
                                    <span><small>{{ isset(Auth::user()->name) ? Auth::user()->name : Auth::user()->email }}</small></span>
                                </a>
                            </div>
                        @endauth
                        <div><a href="{{ route('orders') }}"><i class="bi bi-receipt h4"></i></a></div>
                        <div id="cart-action">@livewire('cart.cart')</div>
                         <div id="mobile-menu-action">
                            <i class="bi bi-list h3" onclick="callMenu()"></i>
                            @livewire('helpers.mobile-nav')
                        </div>
                        
                        <script>
                            function callMenu() {
                                Livewire.dispatch('toggle');
                            }
                        </script>
                    </div>
                    {{-- Menu --}}
                    <div id="menu" class="control center">
                        <x-helpers.menu :items="[
                            'mixed packages',
                            'vegetables',
                            'prepackaged fruit and platters',
                            'sauces',
                            'seasonings',
                            'dry rubs(packs)',
                            'meats',
                            'seafood',
                            'marinades',
                        ]"> </x-helpers.menu>
                    </div>
                </section>
                {{-- Shop By --}}
                <section id="shopBy">
                    <x-helpers.shop-by :items="['healthy', 'popular', 'diwali']">
                    </x-helpers.shop-by>
                </section>
            </div>
        </nav>
    </header>
    <main>
        {{ $slot }}
    </main>
    <footer>
        <div class="backtotop">
            <button type="button" id="btpBtn">Back To Top</button>
        </div>
        <script>
            document.getElementById('btpBtn').onclick = function() {
                window.scrollTo(0, 0);
            }
        </script>
        <div class="links">
            <div class="column">
                <p class="heading">Categories</p>
                <div class="list">
                    <a href="{{ route('results', ['find' => 'Mixed Packages']) }}">Mixed Packages</a>
                    <a href="{{ route('results', ['find' => 'Vegetables']) }}">Vegetables</a>
                    <a href="{{ route('results', ['find' => 'Prepackaged Fruit and Vegetables']) }}">Prepackaged Fruit
                        and Vegetables</a>
                    <a href="{{ route('results', ['find' => 'Salts']) }}">Salts</a>
                    <a href="{{ route('results', ['find' => 'Sauces']) }}">Sauces</a>
                    <a href="{{ route('results', ['find' => 'Seasonings']) }}">Seasonings</a>
                    <a href="{{ route('results', ['find' => 'Dry Rubs']) }}">Dry Rubs</a>
                    <a href="{{ route('results', ['find' => 'Meats']) }}">Meats</a>
                    <a href="{{ route('results', ['find' => 'Seafood']) }}">Seafood</a>
                    <a href="{{ route('results', ['find' => 'Marinades']) }}">Marinades</a>
                </div>
            </div>
            <div class="column">
                <p class="heading">Useful Links</p>
                <div class="list">
                    <a href="{{ route('about') }}">About</a>
                    <a href="{{ route('contact') }}">Contact</a>
                    <a href="{{ route('more') }}">More</a>
                    <a href="{{ route('terms-and-conditions') }}">Terms and Conditions</a>
                    <a href="{{ route('delivery') }}">Delivery</a>
                </div>
            </div>
            <div class="column">
                <p class="heading">Social Media</p>
                <div class="social-list">
                    <a href="https://www.instagram.com/fresh2gohub?igsh=MWxhYTVqcTVqNDZxMg=="> <i class="bi bi-instagram h4"></i></a>
                    <a href="https://www.facebook.com/profile.php?id=61560308751020"> <i class="bi bi-facebook h4"></i></a>

                </div>
            </div>
        </div>
        <div class="bar">
            <small> All rights reserved to Fresh2GoHub</small>
        </div>
    </footer>
</body>


{{-- Nav Behavior --}}
<script>
    const menu = document.querySelector("#menu");
    const filters = document.querySelector("#shopBy");
    window.addEventListener('scroll', () => {
        if (window.scrollY > 20) {
            menu.classList.add('hide');
        } else {
            menu.classList.remove('hide');
        }
    })
</script>

</html>
