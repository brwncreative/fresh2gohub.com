<nav id="main-nav">
    @livewire('nav.mini-nav')
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
                    height="55px" width="auto" fetchpriority="high" loading="eager" alt="Fresh2Go Logo"></img>
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
            <a href="{{ route('/') }}">
                <p>Set / Address</p>
            </a>
        </div>
        <div id="a-account" class="action">
            <strong>Account Area</strong>
            <a href="{{ route('login') }}">
                <p>Login / Sign up</p>
            </a>
        </div>
        <div id="a-coupons" class="action"><i class="bi bi-ticket h2"></i></div>
        <div id="a-cart" class="action"><i class="bi bi-basket h2"></i>
        </div>
        <div id="a-options"><i class="bi bi-list" onclick="toggle()"></i></div>
    </div>
    {{-- Menu --}}
    <menu id="menu" class="nav-element center">
        @livewire('nav.menu', ['menuItems' => ['mixed packages', 'vegetables', 'prepackaged fruit and platters', 'mash', 'sauces', 'seasonings', 'dry rubs(packs)', 'meats', 'seafood', 'marinades']])
    </menu>
    {{-- Filters --}}
    <div id="filters" class="nav-element">
        <label>Shop by:</label>
        @livewire('nav.tags', ['tags' => ['healthy', 'snack', 'express', 'delivery', 'popular'], 'style' => 'display:flex; justify-content:center; align-items:center; margin-inline:.2rem; background-color:rgb(245, 245, 245); width:auto; height:35px; border-radius:20px; padding-inline:1rem; border:1px solid rgb(139, 139, 139); font-size:.9rem'])
    </div>
</nav>


<script>
    function toggle() {
        Livewire.dispatchTo('nav.mini-nav', "showNav")
    }
</script>
