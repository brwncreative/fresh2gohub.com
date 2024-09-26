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
    @vite(['resources/css/checkout/cart.css', 'resources/css/results/results.css', 'resources/css/products/products.css', 'resources/css/helpers.css', 'resources/js/app.js', 'resources/css/app.css', 'resources/css/navigation/standard-nav.css', 'resources/css/welcome/welcome.css', 'resources/css/sections/sections.css'])
</head>

<body>
    <header>
        {{-- Navigation container --}}
        <nav id="standard-nav">
            {{-- Navigation Links --}}
            <section id="nav-links">
                <a href=""><small>About</small></a>
                <a href=""><small>Contact</small></a>
                <a href=""><small>More</small></a>
                <a href=""><small>Terms and Conditions</small></a>
                <a href=""><small>Delivery</small></a>
            </section>
            {{-- Main nav elements --}}
            <section id="nav-main">
                {{-- Logo --}}
                <div id="logo" class="center">
                    <a href="{{ route('welcome') }}"> <img
                            src="{{ App\Http\Controllers\MediaController::serveImage('logo', 'svg') }}" height="50px"
                            width="auto" fetchpriority="high" loading="eager" alt="Fresh2Go Logo"></img>
                    </a>
                    <div class="v-divider"></div>
                </div>
                {{-- Searchbar --}}
                <div id="searchbar" class="center"><livewire:utilities.search-bar></livewire:utilities.search-bar></div>
                {{-- Actions --}}
                <div id="actions">
                    @auth
                        <div><a href=""><i class="bi bi-truck h3"></i></a></div>
                    @endauth
                    @guest
                        <div><a href="{{ route('login') }}"><i class="bi bi-person h3"></i></a></div>
                    @endguest
                    @auth
                        <div class="auth-greeting">
                            <a href="{{ Auth::user()->role != 'guest' ? route('dashboard') : route('logout') }}">
                                <span class="paragraph">Hi</span>
                                <span><small>{{ isset(Auth::user()->name) ? Auth::user()->name : Auth::user()->email }}</small></span>
                            </a>
                        </div>
                    @endauth
                    <div><a href="{{ route('orders') }}"><i class="bi bi-receipt h3"></i></a></div>
                    <div id="cart-action">@livewire('cart.cart')</div>
                    <div id="mobile-menu-action">
                        <i class="bi bi-list h3" onclick="callMenu()"></i>
                        @livewire('helpers.mobile-nav')
                    </div>
                    {{-- Livewire interaction - Mobile menu --}}
                    <script>
                        function callMenu() {
                            Livewire.dispatch('toggle');
                        }
                    </script>
                    {{-- --- --}}
                </div>
                {{-- Menu --}}
                <div id="menu" class="center"><x-helpers.menu :items="[
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
                ]"> </x-helpers.menu>
                </div>
            </section>
            {{-- Nav shopy by filters --}}
            <section id="nav-shopby">
                <x-helpers.shop-by :items="['healthy', 'popular', 'diwali']">
                </x-helpers.shop-by>
            </section>
        </nav>
    </header>
    {{ $slot }}
    <footer>
        <div id="message">
            <div class="disclaimer">
                <p>We hope you enjoy Fresh2GoHub.com! If you have any feedback for us <br> don't be afraid to contact us
                    and give us some feedback</p>
            </div>
            <div class="social-links">
                <i class="bi bi-instagram"></i>
                <i class="bi bi-facebook"></i>
                <i class="bi bi-tiktok"></i>
            </div>
            <div class="tech"><a href="">Powered by Brwncreative</a></div>
        </div>

        {{-- <div id="footer-pattern">
            <div class="mask"></div><img
                src="{{ App\Http\Controllers\MediaController::serveImage('Fresh2GoHub_Pattern', 'svg') }}"
                alt="">
        </div> --}}
    </footer>
</body>
<script>
    const menuArea = document.querySelector("#menu");
    const menu = document.querySelector("#menu-bucket");
    const filters = document.querySelector("#nav-shopby");
    window.addEventListener('scroll', () => {
        if (window.scrollY > 20) {
            menuArea.classList.add("hide-menu");
            menu.classList.add("hide-menu");
            filters.style.display = 'none';
        } else {
            menuArea.classList.remove("hide-menu");
            menu.classList.remove("hide-menu");
            filters.style.display = 'flex';
        }
    })
</script>

</html>
