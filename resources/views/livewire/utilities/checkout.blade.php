<main id="checkout">
    <p class="medium-title">Checkout ${{ number_format($total, 2, '.', '') }}</p>
    <p>Lets get you those eats!</p>
    <p class="paragraph">Please note additional costs for the different payment options</p>
    <hr>
    <div class="bucket">
        <div id="cart-items">
            @if (count($cart) < 1)
                <p class="medium-title"> See what we have in store and come back!</p>
            @endif
            @isset($cart)
                @foreach ($cart as $item)
                    <div class="item">
                        <div class="image">
                            <div>
                                <img src="{{ App\Http\Controllers\MediaController::serveImage('product-' . $item['id'], 'webp') }}"
                                    alt="" />
                            </div>
                        </div>
                        <div class="id">
                            <span>
                                <p>{{ $item['name'] }} </p>
                                <p class="bold"> {{ $item['provider'] }}</p>
                            </span>
                            <p class="paragraph">{{ $item['description'] }}</p>
                        </div>
                        <div class="cost">
                            <span>
                                <small>
                                    <p>Qty: {{ $item['quantity'] }}</p>
                                </small>
                                @if ($item['selectedOpt']['option'] == 'Check Options')
                                    <p class="">${{ $item['selectedPri']['value'] }} /
                                        {{ $item['selectedPri']['metric'] }}</p>
                                @else
                                    <p class="">{{ $item['selectedOpt']['option'] }} @
                                        ${{ $item['selectedOpt']['value'] }}</p>
                                @endif
                            </span>
                        </div>
                        <div class="actions">
                            <i class="bi bi-trash h6 delete"
                                wire:click="$dispatch('removeFromCart',{id: {{ $item['id'] }}, source: 'checkout'})"></i>
                            <i class="bi bi-dash-circle remove h4"
                                wire:click="$dispatch('addToCart',{how: '-', id: {{ $item['id'] }}, source: 'checkout'})"></i>
                            <button
                                wire:click="$dispatch('addToCart',{how: '+',id: {{ $item['id'] }}, source: 'checkout'})"><i
                                    class="bi bi-plus h4"></i></button>
                        </div>
                    </div>
                @endforeach
            @endisset
        </div>
        <div id="checkout-form">
            <p class="small-title">Order Info and Payment</p>
            <p class="paragraph">Psst.. Don't worry any information stored is secured and used for your order</p>
            <form>
                <div>
                    <input wire:model='fname' type="text" placeholder="First Name">
                    <input wire:model='lname' type="text" placeholder="Last Name">
                </div>
                <input wire:model='email' type="email" placeholder="Email">
                <input wire:model='contact' type="text" placeholder="Contact">
                <input wire:model='area' type="text" list="tt-areas" placeholder="Area" wire:model='area' />
                <datalist class="ci-input" id="tt-areas">
                    <option value="Mayaro"></option>
                </datalist>
                <input wire:model='address' type="text" placeholder="Address">
                <input wire:model='instructions' type="text" placeholder="Delivery Instructions">
                <select wire:model='via' class="ci-input" wire:model='via'>
                    <option value="Receive the order by...">Receive the order via...</option>
                    <option value="Delivery">Delivery</option>
                    <option value="Meet Up">Meet Up</option>
                </select>
            </form>
            <div id="payment">
                <div id="payment-options">
                    <button wire:click="$set('paymentOption','bank')">Bank</button>
                    <button wire:click="$set('paymentOption','wipay')" class="wipay-btn">WiPay</button>
                </div>
                <div id="payment-actions">
                    @if ($paymentOption === 'bank')
                        <div>
                            <small>
                                <p class="bold">Bank Details</p>
                                <p class="paragraph">Keep your order number safe yuh' hear</p>
                                <p>Bank: Republic Bank Limited</p>
                                <p>Name: Tajah Ieasha Lawrence</p>
                                <p>Chq: 470463726301</p>
                            </small>
                        </div>
                        <button class="purchase-btn bold">Purchase</button>
                        {{-- wire:click='pay' --}}
                    @endif
                    @if ($paymentOption === 'wipay')
                        <button class="purchase-btn bold" >Purchase</button>
                    @endif
                </div>
            </div>
        </div>
    </div>
</main>
