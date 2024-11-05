<div id="checkout">
    <h4 class="bold" style="margin-bottom:1rem">Checkout <span
            style="padding-inline:1rem;background-color:rgb(229, 248, 202); color: green">
            ${{ number_format($total, 2, '.', '') }}</span> </h4>
    <h6>You can practically taste it at this point</h6>
    <p class="paragraph">Please note , Debit/ Credit card payment options carry an additional cost</p>
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
                            <p class="bold">{{ $item['provider'] }} {{ $item['name'] }}</p>
                            <p class="paragraph">{{ $item['description'] }}</p>
                        </div>
                        <div class="cost">
                            <span>
                                <small>
                                    <p>Qty: {{ $item['quantity'] }}</p>
                                </small>
                                @if ($item['selectedOpt']['option'] == 'Check Options')
                                    <p class="bolder">${{ $item['selectedPri']['value'] }} /
                                        {{ $item['selectedPri']['metric'] }}</p>
                                @else
                                    <p class="bolder">{{ $item['selectedOpt']['option'] }} @
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
                        <div id="bank-details" class="details">
                            <h6 class="bold">Bank Details</h6>
                            <p>Bank: Republic Bank Limited</p>
                            <p>Name: Tajah Ieasha Lawrence</p>
                            <p>Chq: 470463726301</p>
                        </div>
                    @endif
                    @if ($paymentOption === 'wipay')
                        <div id="wipay-details" class="details">
                            <h6 class="bold">WiPay Details</h6>
                            <p>Do note there is a small fee attached to this payment option.</p>
                        </div>
                    @endif
                    <button class="purchase-btn bold" wire:click='pay'>Purchase</button>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div id="terms-and-conditions" class="terms">
        <h5>Terms and conditions</h5>
        <ol>
            <li>
                <p class="heading">Introduction</p>
                <p class="paragraph">Welcome to Fresh2Go Hub. By accessing or using our website and purchasing our
                    products, you agree to comply with and be bound by the following terms and conditions. Please read
                    them carefully.</p>
            </li>
            <li>
                <p class="heading">Products and Services</p>
                <p class="paragraph">Fresh2Go Hub provides prepped food products including fruits, vegetables, meats,
                    salts, and marinades. All products are packaged with care to maintain freshness and quality.
                    However, as they are perishable, it is important to follow recommended storage instructions to
                    maximize shelf life.</p>
            </li>
            <li>
                <p class="heading">Ordering and Payment</p>
                <p class="paragraph">All orders must be placed through our website. Payment can be made via accepted
                    credit or debit cards as well as bank transfer. If the bank transfer option is selected, you have 2
                    days to upload proof of payment before the order is cancelled. Upon placing an order, you will
                    receive an email confirmation detailing your order as well as an order number in which you can use
                    to
                    upload proof of payment or check on the status of your order. If any issues arise, please contact
                    our customer support team.</p>
            </li>
            <li>
                <p class="heading">Shipping and Delivery</p>
                <p class="paragraph">We offer delivery within designated areas through the use of a partnership delivery
                    service. Delivery fees and estimated times may vary based on location as well as day and time in
                    which the courier service delivers to your area. Fresh2Go Hub cannot be held responsible for delays
                    due to unforeseen circumstances because once your package is passed off to the courier, we are no
                    longer in control as we have fulfilled our part of the agreement which is to package your product
                    and pass it off to be delivered to you at your designated location. If you are not available at the
                    delivery time, please arrange for someone to receive your order or give instructions on where to
                    leave the package to the courier driver.</p>
            </li>
            <li>
                <p class="heading">Return Policy</p>
                <p class="paragraph">Due to the perishable nature of our products, Fresh2Go Hub generally does not
                    accept returns. However, if you receive a damaged or incorrect item, please contact our customer
                    service team within 24 hours of receiving your order. We may offer a replacement or refund at our
                    discretion. Proof of damage or defect (such as photos) may be required to process your claim.</p>
            </li>
            <li>
                <p class="heading">Product Quality</p>
                <p class="paragraph">While we make every effort to ensure the highest quality, please note that
                    freshness may vary slightly depending on storage conditions. Products should be consumed by the
                    recommended "use by" dates on their packaging.</p>
            </li>
            <li>
                <p class="heading">Liability</p>
                <p class="paragraph">Fresh2Go Hub is not liable for any indirect, incidental, or consequential damages
                    that may result from the use of our products. Please review all ingredients for potential allergens,
                    as Fresh2Go Hub is not responsible for allergic reactions.</p>
            </li>
            <li>
                <p class="heading">Amendments to Terms and Conditions</p>
                <p class="paragraph">Fresh2Go Hub reserves the right to update or amend these terms and conditions at
                    any time. Any changes will be posted on this page. Continued use of our site and services
                    constitutes acceptance of any modified terms.</p>
            </li>
            <li>
                <p class="heading">Contact Us</p>
                <p class="paragraph">For questions regarding these terms, or if you have concerns about your order,
                    please reach out to our customer service team.</p>
            </li>
        </ol>

        {{-- LinK Behaiour --}}
        @if (Route::is('terms-and-conditions'))
            <script>
                document.getElementById('terms-and-conditions').scrollIntoView({
                    behavior: 'smooth',
                    block: 'start',
                });
            </script>
        @endif
        @if (Route::is('delivery'))
            <script>
                document.getElementById('terms-and-conditions').scrollIntoView({
                    behavior: 'smooth',
                    block: 'start',
                });
            </script>
        @endif
    </div>
</div>
