<div class="order" wire:click="$toggle('active')">
    @if ($viewScreenshot)
        <div class="screenshot">dsad</div>
    @endif
    <div class="order-details order-{{ $order->ticket }}">
        {{-- Order details --}}
        <p class="paragraph">Ticket: <span class="bold">{{ $order->ticket }}</span></p>
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
                        <td class="paragraph-reg">{{ $order->area }} ; {{ $order->address }}</td>
                    </tr>
                    <tr>
                        <td class="paragraph">Via:</td>
                        <td class="paragraph-reg">{{ $order->via }}</td>
                    </tr>
                    <tr>
                        <td class="paragraph">Status:</td>
                        <td class="paragraph-reg" style="color:{{ $order->status == 'unpaid' ? 'red' : 'green' }}">
                            {{ $order->status }}</td>
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
            <div class="actions">
                <button wire:click="$toggle('viewScreenshot')"><i class="bi bi-receipt"></i></button>
            </div>
        </div>
    </div>
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
                    @foreach ($order->transactions as $transaction)
                        <tr>
                            <td class="paragraph-reg">{{ $transaction->product->name }}</td>
                            <td class="paragraph-reg">{{ $transaction->option }}</td>
                            <td class="paragraph-reg">{{ $transaction->metric }}</td>
                            <td class="paragraph-reg">{{ $transaction->value }}</td>
                            <td class="paragraph-reg">{{ $transaction->quantity }}</td>
                            <td class="paragraph-reg">
                                {{ number_format($transaction->quantity * $transaction->value, 2, '.', '') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
