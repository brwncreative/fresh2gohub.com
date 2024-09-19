<main id="orders">
    {{-- WiPay Resp --}}
    @if ($response)
        <div id="response">
            <div id="response-container" class="{{ $resp_active ? 'active' : '' }}">
                <i wire:click="$toggle('resp_active')" id="close-response" class="bi bi-x-lg"></i>
                <p class="medium-title bold">Transaction details: </p>
                <p class="paragraph">Review your wipay transaction details below</p>
                <div id="response-details">
                    <div>
                        <p>Card</p>
                        <p>Currency</p>
                        <p>Address</p>
                        <p>Email</p>
                        <p>Phone</p>
                        <p>Name</p>
                        <p>Date</p>
                        <p>Message</p>
                        <p>Ticket</p>
                        <p>Status</p>
                        <p>Total</p>
                    </div>
                    <div>
                        <p>{{ $response['card'] }}</p>
                        <p>{{ $response['currency'] }}</p>
                        <p>{{ $response['customer_address'] }}</p>
                        <p>{{ $response['customer_email'] }}</p>
                        <p>{{ $response['customer_phone'] }}</p>
                        <p>{{ $response['customer_name'] }}</p>
                        <p>{{ $response['date'] }}</p>
                        <p>{{ $response['message'] }}</p>
                        <p>{{ $response['order_id'] }}</p>
                        <p style="color:{{ $response['status'] == 'success' ? 'green' : 'red' }}">
                            {{ $response['status'] }}</p>
                        <p>{{ $response['total'] }}</p>
                    </div>
                </div>
            </div>
            <div id="vail" class="vail-{{ $resp_active ? 'active' : '' }}">></div>
        </div>
    @endif
    {{-- Toolbar --}}
    <div class="toolbar">
        <div class="greeting">
            <p class="medium-title">Orders</p>
            <p class="paragraph">Interact with orders here</p>
        </div>
        <div class="searchbar">
            <input wire:model='ticket' type="text" placeholder="Ticket No.">
            <div><i class="bi bi-search h5" wire:click='find'></i></div>
        </div>
        <div class="print">
            <p> Print this page as invoice ->
            </p>
        </div>
    </div>
    {{-- Container --}}
    <div class="bucket">
        @if (count($orders) > 0)
            {{-- Order --}}
            <div class="order">
                @foreach ($orders as $order)
                    {{-- Order Information --}}
                    <div class="order-information">
                        <div class="id">
                            <p class="paragraph"><span class="small-title">{{ $order->name }}
                                </span>{{ $order->created_at }}</p>
                        </div>
                        <table>
                            <tbody>
                                <tr>
                                    <th style="width: 8rem"></th>
                                    <th></th>
                                </tr>
                                <tr>
                                    <td>
                                        <p class="paragraph">Contact:</p>
                                    </td>
                                    <td>
                                        <p>{{ $order->contact }}</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p class="paragraph">Area:</p>
                                    </td>
                                    <td>
                                        <p>{{ $order->area }}</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p class="paragraph">Address:</p>
                                    </td>
                                    <td>
                                        <p>{{ $order->address }}</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p class="paragraph">instructions:</p>
                                    </td>
                                    <td>
                                        <p>{{ $order->instructions }}</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p class="paragraph">via:</p>
                                    </td>
                                    <td>
                                        <p>{{ $order->via }}</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p class="paragraph">status:</p>
                                    </td>
                                    <td>
                                        <p><span class="status-{{ $order->status }}">{{ $order->status }}</span></p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <hr>
                    <div class="order-transactions">
                        @foreach ($order->transactions as $transaction)
                            <div class="transaction">
                                <div></div>
                                <div>
                                    <p>Product: <span class="bold">Product</span></p>
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
                    <div id="actions">
                        <button><i class="bi bi-camera"></i>Upload screenshot</button>
                        <button>Send message</button>
                        <button>Feedback</button>
                    </div>
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
            <div id="history">
                <p class="small-title">Previous orders for
                    {{ Auth::user()->name ? Auth::user()->name : Auth::user()->email }}
                </p>
                <p class="paragraph">
                    See your previous orders below:
                </p>
            </div>
        @endauth
    </div>
</main>
