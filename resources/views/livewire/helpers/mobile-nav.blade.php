<div id="mobile-nav" class="bold {{ $active ? 'active show' : 'in-active' }}">
    <i class="bi bi-caret-up-fill tail"></i>
    @if (Auth::user())
        @if (Auth::user()->role == 'admin')
            <a href="{{ route('dashboard') }}"><span class="paragraph">Hi</span> {{ Auth::user()->name }}</a>
        @else
            <a href="{{ route('logout') }}"><span class="paragraph">Hi</span> {{ Auth::user()->name }}</a>
        @endif
    @else
        <a href="{{ route('login') }}">Login</a>
    @endif
    <a href="{{ route('welcome') }}">Home</a>
    <a href="{{ route('orders') }}">Orders</a>
    <a href="{{ route('checkout') }}">Checkout</a>
</div>
