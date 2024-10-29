<div class="order">
    {{-- Order details --}}
    <div class="order-details order-{{ $order->ticket }}">
        <div class="heading">
            <h5>Ticket: <span class="bold">{{ $order->ticket }}</span></h5>
            <button wire:click="$toggle('viewScreenshot')"><i class="bi bi-receipt"></i></button>
            <button wire:click="$toggle('active')"> Transactions</button>
            <button><i class="bi bi-printer"></i></button>
            <button wire:click='deleteOrder'  wire:confirm="Are you sure you want to delete this order?">Delete</button>
        </div>
        <div class="estimate">
            <p>Total: ${{ number_format($order->total, 2, '.', '') }}</p>
        </div>
        <hr>
        <div class="order-information">
            <table class="information">
                <tbody>
                    <tr>
                        <td style="width:5rem" class="paragraph">Name:</td>
                        <td>{{ $order->name }}</td>
                    </tr>
                    <tr>
                        <td class="paragraph">Method:</td>
                        <td class="paragraph-reg">{{ $order->method }}</td>
                    </tr>
                    <tr>
                        <td class="paragraph">Contact:</td>
                        <td class="paragraph-reg">{{ $order->contact }}</td>
                    </tr>
                    <tr>
                        <td class="paragraph">Email:</td>
                        <td class="paragraph-reg">{{ $order->email }}</td>
                    </tr>
                    <tr>
                        <td class="paragraph">Area:</td>
                        <td class="paragraph-reg">{{ $order->area }} : {{ $order->address }}</td>
                    </tr>
                    <tr>
                        <td class="paragraph">Via:</td>
                        <td class="paragraph-reg">{{ $order->via }}</td>
                    </tr>
                    <tr>
                        <td class="paragraph">Status:</td>
                        <td class="paragraph-reg toggle-paid">
                            <div class="toggle {{ $paid ? 'thumb-active' : '' }}" wire:click="$toggle('paid')">
                                <div class="thumb"></div>
                            </div>
                            <p style="color:{{ $paid ? 'green' : 'red' }}">
                                {{ $paid ? 'paid' : 'unpaid' }}
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td class="paragraph">Stage:</td>
                        <td>
                            <div class="stage">
                                <p class="{{ $stage == 'received' ? 'active' : '' }}"
                                    wire:click="$set('stage','received')">Recevied</p>
                                <p class="{{ $stage == 'prepping' ? 'active' : '' }}"
                                    wire:click="$set('stage','prepping')">Prepping</p>
                                <p class="{{ $stage == 'packaged' ? 'active' : '' }}"
                                    wire:click="$set('stage','packaged')">Packaged</p>
                                <p class="{{ $stage == 'out on delivery' ? 'active' : '' }}"
                                    wire:click="$set('stage','out on delivery')">Out on Delivery</p>
                            </div>
                        </td>
                        <style>

                        </style>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    {{-- Proof of Purchase --}}
    @if ($viewScreenshot)
        <div class="pop">
            @if ($imageFromStorage)
                <img src="data:image/{{ $imageFromStorage['ext'] }};base64, {{ $imageFromStorage['stream'] }}"
                    alt="">
            @endif
        </div>
    @endif
    {{-- Transactions --}}
    <div class="transactions {{ $active ? 'active' : '' }}">
        <div class="transaction {{ $active ? 'active' : '' }}">
            <table>
                <tbody>
                    <tr>
                        <th class="paragraph-reg" style="
                            width:12rem">Product Name</th>
                        <th class="paragraph-reg" style="
                            width:6rem">Option</th>
                        <th class="paragraph-reg" style="
                            width:6rem">Metric</th>
                        <th class="paragraph-reg" style="
                            width:6rem">Value</th>
                        <th class="paragraph-reg" style="
                            width:6rem">Quantity</th>
                        <th class="paragraph-reg" style="
                            width:6rem">Total</th>
                    </tr>
                    <tr>
                        <th class="paragraph-reg" style="
                        width:12rem"></th>
                        <th class="paragraph-reg" style="
                        width:6rem"></th>
                        <th class="paragraph-reg" style="
                        width:6rem"></th>
                        <th class="paragraph-reg" style="
                        width:6rem"></th>
                        <th class="paragraph-reg" style="
                        width:6rem"></th>
                        <th class="paragraph-reg" style="
                        width:6rem"></th>
                    </tr>
                    @foreach ($order->transactions as $transaction)
                        <tr>
                            <td class="paragraph-reg">{{ $transaction->product->name }}</td>
                            <td class="paragraph-reg">{{ $transaction->option ? $transaction->option : 'NA' }}</td>
                            <td class="paragraph-reg">{{ $transaction->metric }}</td>
                            <td class="paragraph-reg">{{ $transaction->value }}</td>
                            <td class="paragraph-reg">{{ $transaction->quantity }}</td>
                            <td class="paragraph-reg">
                                ${{ number_format($transaction->quantity * $transaction->value, 2, '.', '') }}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td class="bold">${{ number_format($order->total, 2, '.', '') }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
