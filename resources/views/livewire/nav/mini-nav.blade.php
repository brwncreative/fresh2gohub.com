<div id="mini-nav" class="center {{ $toggle ? 'show-mn' : '' }}">
    <div id="mn-contents">
        <div id="mn-actions">
            <div class="action"> <strong>Account Area</strong>
                <a href="{{ route('login') }}">
                    <p>Login / Sign up</p>
                </a>
            </div>
            <div class="action">
                <strong>Delivery</strong>
                <a href="{{ route('/') }}">
                    <p>Set / Address</p>
                </a>
            </div>
            <div class="action">
                <i class="bi bi-ticket h2"></i>
            </div>
            <div class="action">
                <h1> <i class="bi bi-x" wire:click="showNav"></i> </h1>
            </div>
        </div>
        <div id="checkout" class="center">
            <button>checkout</button>
        </div>
    </div>
</div>
