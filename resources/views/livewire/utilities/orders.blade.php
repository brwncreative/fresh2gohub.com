<main id="orders">
    {{-- Toolbar --}}
    <div class="toolbar">
        <div>
            <p class="medium-title">Orders</p>
            <p class="paragraph">Interact with orders here</p>
        </div>
        <div class="searchbar">
            <input wire:model='ticket' type="text" placeholder="Ticket No.">
            <div></div>
        </div>
        <div class="print">
            <i class="bi bi-printer h3"></i>
        </div>
    </div>
    {{-- Container --}}
    <div class="bucket">
        @if ($ticket)
            {{ json_encode($order) }}
            <div class="order">
                <div>
                   <p> Created</p>
                   <p> Method</p>
                   <p> Name</p>
                    <p>Contact</p>
                    <p>Area</p>
                    <p>Address</p>
                    <p>Instructions</p>
                   <p> Via</p>
                   <p> Total</p>
                   <p> Status</p>
                </div>
                <div>
                    @foreach ($order->transactions() as $transaction)
                        
                    @endforeach
                </div>
            </div>
        @else
            @guest
                <p class="paragraph">You can use here to check your order status, confirm your order or ask a question
                    about it</p>
            @endguest
            @auth

            @endauth
        @endif
    </div>
</main>
