<div id="checkout">
    <h3 class="bold">Checkout ${{ number_format($total, 2, '.', '') }}</h3>
    <h5>Lets get you those eats!</h5>
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
                            <i class="action bi bi-trash h6 delete"
                                wire:click="$dispatch('removeFromCart',{id: {{ $item['id'] }}, source: 'checkout'})"></i>
                            <i class="action bi bi-dash h4 remove "
                                wire:click="$dispatch('addToCart',{how: '-', id: {{ $item['id'] }}, source: 'checkout'})"></i>
                            <i class="action bi bi-plus h4 add"
                                wire:click="$dispatch('addToCart',{how: '+',id: {{ $item['id'] }}, source: 'checkout'})"></i>
                        </div>
                    </div>
                @endforeach
            @endisset
        </div>
        <div id="checkout-form">
            @if ($errors->any())
                <div class="errors">
                    <h6><span class="bold"> Don't worry</span> <br> we just need a few details</h6>
                    <ul>
                        @foreach ($errors->getBags() as $error)
                            @foreach ($error->getMessages() as $message)
                                <li>{{ $message[0] }}</li>
                            @endforeach
                        @endforeach
                    </ul>
                </div>
            @endif
            <form>
                <div>
                    <input size='1' wire:model='fname' type="text" placeholder="First Name">
                    <input size='1' wire:model='lname' type="text" placeholder="Last Name">
                </div>
                <input size='1' wire:model='email' type="email" placeholder="Email">
                <input size='1' wire:model='contact' type="text" placeholder="Contact">
                <input size='1' wire:model='area' type="text" list="tt-areas" placeholder="Area"
                    wire:model='area' />
                <datalist class="ci-input" id="tt-areas">
                    <option value="Mayaro"></option>
                </datalist>
                <input size='1' wire:model='address' type="text" placeholder="Address">
                <input size='1' wire:model='instructions' type="text" placeholder="Delivery Instructions">
                <select size='1' wire:model='via' class="ci-input" wire:model='via'>
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
                        <div id="bank-details">
                            <h5 class="bold">Bank Details</h5>
                            <p>Bank: Republic Bank Limited</p>
                            <p>Name: Tajah Ieasha Lawrence</p>
                            <p>Chq: 470463726301</p>
                        </div>
                    @endif
                    @if ($paymentOption === 'wipay')
                        <div id="wipay-details">
                            <h5 class="bold">WiPay Details</h5>
                            <p>Do note there is a small fee attached to this payment option.</p>
                        </div>
                    @endif
                    <button class="purchase-btn bold" wire:click='pay'>Purchase</button>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="terms">
        {{-- <h5>Terms and conditions</h5>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime, fugiat! Dolor, adipisci asperiores! Sequi
            quidem laboriosam possimus maxime qui. Accusamus a officiis dolores at voluptates quod iste labore
            asperiores sint!</p> --}}
    </div>
</div>
