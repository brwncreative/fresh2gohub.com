<main id="orders">
    {{-- Toolbar --}}
    <div class="toolbar">
        <div>
            <p class="medium-title">Orders</p>
            <p class="paragraph">Interact with orders here</p>
        </div>
        <div class="searchbar">
            <input wire:model='ticket' type="text" placeholder="Ticket No.">
            <div><i class="bi bi-search h5" wire:click='find'></i></div>
        </div>
        <div class="print">
            Print this page as invoice ->
        </div>
    </div>
    {{-- Container --}}
    <div class="bucket">
        @if (count($orders) > 0)
            <div class="order">
                @foreach ($orders as $order)
                    <div class="order-information">
                        <div class="identity">
                            <p class="paragraph">Created: {{ $order->created_at }}</p>
                            <p>Name: <span class="small-title">{{ $order->name }}</span></p>
                            <p>Contact: <i class="bi bi-telephone h6"></i></i> {{ $order->contact }}</p>
                        </div>
                        <div class="location">
                            <p>Area: {{ $order->area }}</p>
                            <p>Address: {{ $order->address }}</p>
                            <p>Delivery instructions: {{ $order->instructions }}</p>
                        </div>
                        <div class="payment-details">
                            <p>via: {{ $order->via }}</p>
                            <p>status: <span class="status-{{ $order->status }}">{{ $order->status }}</span> </p>
                        </div>
                    </div>
                    <hr>
                    <div class="order-transactions">
                        @foreach ($order->transactions as $transaction)
                            <div class="transaction">
                                <div></div>
                                <div>
                                    <p>Product: <span class="small-title">Product</span></p>
                                    <p>Option: {{ $transaction->option }}</p>
                                    <p>Value: {{ $transaction->value }}</p>
                                    <p>Metric: {{ $transaction->metric }}</p>
                                    <p>Quantity: {{ $transaction->quantity }}</p>
                                </div>
                                <div>
                                    <p> ${{ number_format($transaction->value * $transaction->quantity, 2, '.', '') }}
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <p class="total">Total: <span class="medium-title">{{ $order->total }}</span></p>
                @endforeach
            </div>
        @else
            @guest
                <p class="paragraph">You can use here to check your order status, confirm your order or ask a question
                    about it</p>
            @endguest
        @endif
        @guest
            <br>
            <p class="small-title">Want to keep track of your orders?</p>
            <p class="paragraph">
                Register to keep track of all your orders (coming soon)
            </p>
        @endguest
        @auth
            <p class="small-title">Previous orders for {{ Auth::user()->name ? Auth::user()->name : Auth::user()->email }}
            </p>
            <p class="paragraph">
                See your previous orders below:
            </p>
        @endauth
    </div>
</main>
