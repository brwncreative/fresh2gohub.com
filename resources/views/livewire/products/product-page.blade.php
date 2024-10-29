<div id="product-page" class={{ $state ? 'active' : 'in-active' }}">
    <div class="bucket {{ $state ? 'active' : 'in-active' }}">
        <i class="bi bi-x-lg bold close" wire:click="$set('state',0)"></i>
        <div id="main-product-details">
            {{-- Image --}}
            <div class="image">
                <div class="img">
                    <img src="{{ App\Http\Controllers\MediaController::serveImage('product-' . $id, 'webp') }}"
                        alt="" />
                </div>
            </div>
            {{-- Id --}}
            <div class="id">
                {{-- Available --}}
                <p class="pill {{ $available ? 'in-stock' : 'out-stock' }} bold">
                    {{ $available ? 'In Stock' : 'Out of Stock' }}
                </p>
                {{-- Category --}}
                <p>{{ $category }}</p>
                {{-- Tags --}}
                <span class="tags">
                    @if ($tags)
                        @foreach ($tags as $tag)
                            <small class="tag tag-{{ $tag['tag'] }}">
                                <p>{{ $tag['tag'] }}</p>
                            </small>
                        @endforeach
                    @endif
                </span>
                {{-- Title and description --}}
                <div class="identifier">
                    <h5>{{ $provider }} : <span class="bold">{{ $name }}</span></h5>
                    <p class="description">{{ $description }}</p>
                </div>
            </div>
            {{-- Actions --}}
            <div class="actions">
                <div class="options">
                    {{-- Options --}}
                    @if ($options)
                        <select wire:model.live='selectedOpt' class="option-{{ $id }}" name="options">
                            <option value='{"option":"Check Options", "value":0}'>Check Options</option>
                            @foreach ($options as $option)
                                <option value="{{ json_encode($option) }}">{{ $option['option'] }}</option>
                            @endforeach
                        </select>
                    @endif
                    {{-- Prices --}}
                    @if ($prices)
                        <select wire:model.live="selectedPri" class="price-{{ $id }}" name="prices">
                            @foreach ($prices as $price)
                                <option value="{{ json_encode($price) }}">{{ $price['value'] }} /
                                    {{ $price['metric'] }}
                                </option>
                            @endforeach
                        </select>
                    @endif
                </div>
                {{-- Buttons --}}
                <div class="buttons">
                    <button class="remove" wire:click="removeAll()"><i class="bi bi-trash"></i></button>
                    <div class="cart">
                        <div class="minus {{ $quantity > 0 ? 'active' : '' }}" wire:click="addToCart('-')"><i
                                class="bi bi-dash-lg"></i></div>
                        <div class="add {{ $quantity > 0 ? 'add-active' : '' }}" wire:click="addToCart('+')">
                            <p>{{ $quantity > 0 ? $quantity : '' }}</p>
                            @if ($quantity > 0)
                                <i class="bi bi-plus-lg h5"></i>
                            @else
                                <i class="bi bi bi-basket h5"></i>
                            @endif


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
