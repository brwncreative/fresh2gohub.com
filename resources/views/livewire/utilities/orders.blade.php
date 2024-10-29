<div id="orders">
    {{-- WiPay --}}
    @if ($showResponse)
        <div class="response">
            <h4>Transaction Details</h4>
            <h6>View Details Below</h6>
            <hr>
            <div class="table">
                {{-- Card --}}
                <p class="heading">Card:</p>
                <p>{{ $response['card'] }}</p>
                {{-- Currency --}}
                <p>Currency:</p>
                <p>{{ $response['currency'] }}</p>
                {{-- Email --}}
                <p>Name:</p>
                <p>{{ $response['customer_name'] }}</p>
                {{-- Phone --}}
                <p>Phone:</p>
                <p>{{ $response['customer_phone'] }}</p>
                {{-- Date --}}
                <p>Date:</p>
                <p>{{ $response['date'] }}</p>
                {{-- Message --}}
                <p>Message:</p>
                <p>{{ $response['message'] }}</p>
                {{-- ID --}}
                <p>Order ID:</p>
                <p>{{ $response['order_id'] }}</p>
                {{-- Status --}}
                <p>Status:</p>
                <p style="color:{{ $response['status'] == 'success' ? 'greenyellow' : 'pink' }}">
                    {{ $response['status'] }}</p>
                {{-- Total --}}
                <p>Total:</p>
                <p>${{ $response['total'] }}</p>
            </div>
            <div class="actions">
                <button wire:click="acknowledge('{{ $response['order_id'] }}')"><i
                        class="bi bi-check2-circle h3"></i></button>
            </div>
        </div>
    @endif
    {{-- Toolbar --}}
    <div class="toolbar">
        {{-- Greeting --}}
        <div class="greeting">
            <h3 class="bold">Orders</h3>
            <p class="paragraph">Interact with orders here</p>
        </div>
        {{-- Searchbar --}}
        <div class="searchbar">
            <input wire:model='ticket' type="text" placeholder="Ticket No.">
            <div><i class="bi bi-search h5" wire:click='find'></i></div>
        </div>
        {{-- Printing action --}}
        <div class="print">
            <button id="print-btn">
                <i class="bi bi-printer"></i>
                <p> Print this page as invoice ->
                </p>
            </button>
        </div>
        <script>
            const printBtn = document.getElementById('print-btn');
            printBtn.addEventListener('click', function() {
                print();
            })
        </script>
        <style>
            @media print {
                body * {
                    display: none;
                }

                main {
                    margin-top: 0 !important;
                    padding: 0 !important;
                }

                main,
                #orders,
                .bucket,
                .order {
                    display: block;
                }

                .order-information {
                    display: block;

                    hr {
                        display: block;
                    }

                    .id {
                        display: block;

                        * {
                            display: block;
                        }
                    }

                    table {
                        display: table;

                        * {
                            display: block;
                        }

                        tr {
                            display: table-row;
                        }

                        td {
                            display: table-cell;


                        }

                    }
                }

                .order-transactions {
                    display: block;

                    * {
                        display: block
                    }
                }

                .total {
                    display: block;

                    * {
                        display: block;
                    }
                }
            }
        </style>
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
                            <h4 class="bold">
                                {{ $order->name }}
                            </h4>
                            <p class="paragraph">
                                {{ date_format($order->created_at, 'd D, F Y (h:i:a)') }}
                            </p>
                            <p>Ticket: {{ $order->ticket }}</p>
                            <p class="total">Total: <span
                                    class="medium-title">${{ number_format($order->total, 2, '.') }}</span></p>
                        </div>
                        <hr>
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
                                        <p>{{ $order->contact }} / ( {{ $order->email }} )</p>
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
                                        <p>{{ $order->instructions ? $order->instructions : 'NA' }}</p>
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
                                        <p class="paragraph">stage:</p>
                                    </td>
                                    <td>
                                        <p><span>{{ $order->stage }}</span>
                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p class="paragraph">status:</p>
                                    </td>
                                    <td>
                                        <p><span
                                                class="status-{{ $order->paid ? 'paid' : 'unpaid' }}">{{ $order->paid ? 'paid' : 'unpaid' }}</span>
                                        </p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="order-transactions">
                        @foreach ($order->transactions as $transaction)
                            <div class="transaction">
                                <div></div>
                                <div>
                                    <p>Product: <span class="bold">{{ $transaction->product->name }}</span></p>
                                    <p>Option: {{ $transaction->option ? $transaction->option : 'NA' }}</p>
                                    <p>Quantity: {{ $transaction->quantity }}</p>
                                </div>
                                <div>
                                    <p> ${{ number_format($transaction->value * $transaction->quantity, 2, '.', '') }}
                                        / {{ $transaction->metric }}
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    {{-- Total --}}
                    <p class="total">Total: <span
                            class="medium-title">${{ number_format($order->total, 2, '.') }}</span></p>
                    {{-- Actions --}}
                    <div id="actions">
                        <button wire:click='displayOrderImage'>See Screenshot Image</button>
                        @if ($order->paid == 0)
                            <input wire:model='image' id="screenshot" type="file" hidden>
                            <label for="screenshot"><i class="bi bi-camera"></i>Upload Screenshot</label>
                            <button wire:click='changePaymentMethod'>Change Payment method</button>
                        @endif
                    </div>
                    {{-- Proof of payments --}}
                    <div class="proofOfPayment">
                        @if ($imageFromStorage)
                            <img src="data:image/{{ $imageFromStorage['ext'] }};base64, {{ $imageFromStorage['stream'] }}"
                                alt="">
                        @endif
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
                <div class="text">
                    <p class="small-title">Previous orders for
                        {{ Auth::user()->name ? Auth::user()->name : Auth::user()->email }}
                    </p>
                    <p class="paragraph">
                        See your previous orders below:
                    </p>
                </div>
                <hr>
                <div id="order-history">
                    @foreach ($history as $order)
                        <div class="previous-order">
                            <div class="info">
                                <h5>Ticket: {{ $order->ticket }}</h5>
                                <p class="paragraph"> {{ date_format($order->created_at, 'd D, F Y (h:i:a)') }}</p>
                                <p>Payment method: {{ $order->method }}</p>
                                <p>Stage: {{ $order->stage }}</p>
                                <p>Paid: <span style="color:{{ $order->paid ? 'green' : 'red' }}">
                                        {{ $order->paid ? 'paid' : 'unpaid' }}
                                    </span>
                                </p>
                            </div>
                            <div class="actions">
                                <a href="{{ route('orders', ['ticket' => $order->ticket]) }}"><i
                                        class="bi bi-receipt h3"></i></a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endauth
    </div>
</div>
