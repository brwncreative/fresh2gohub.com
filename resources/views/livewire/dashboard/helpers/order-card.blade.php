<div class="order" wire:click="$toggle('active')">
    <div class="order-details">
        <table>
            <tbody>
                <p class="paragraph-reg">Ticket: <span class="bold">{{ $order->ticket }}</span></p>
                <tr>
                    <td style="width:5rem">Name:</td>
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
            </tbody>
        </table>
    </div>
    <div class="transactions">
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
