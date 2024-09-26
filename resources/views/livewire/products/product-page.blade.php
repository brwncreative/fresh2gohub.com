<div id="product-page" style="{{ $state ? 'pointer-events: all' : '' }}">
    <div class="bucket {{ $state ? 'active' : 'in-active' }}">
        <i class="bi bi-x-lg bold close" wire:click="$set('state',0)"></i>
        <div id="main-product-details">
            {{-- Image --}}
            <div class="image">
                <div class="img">
                    <img src="{{ App\Http\Controllers\MediaController::serveImage($name, 'webp') }}" alt="" />
                </div>
            </div>
            {{-- Id --}}
            <div class="id">
                {{-- Category --}}
                <p>{{ $category }}</p>
                {{-- Available --}}
                <p class="{{ $available ? 'in-stock' : 'out-stock' }} bold">
                    {{ $available ? 'In Stock' : 'Out of Stock' }}
                </p>
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
                <p class="medium-title">{{ $provider }} : <span class="bold">{{ $name }}</span></p>
                <p class="description">{{ $description }}</p>
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
                    <div class="todowCart">
                        <p class="minus" wire:click="addToCart('-')"><i class="bi bi-dash-lg"></i></p>
                        <p>
                            {{ $quantity }}
                        </p>
                        <p class="add" wire:click="addToCart('+')"><i class="bi bi-plus-lg"></i></p>
                    </div>
                </div>
            </div>
        </div>
        <div id="ft-related-products">
            <p class="small-title">Products related to this -></p>
        </div>
    </div>
</div>
