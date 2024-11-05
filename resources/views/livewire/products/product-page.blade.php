<div id="product-page" class={{ $state ? 'active' : 'in-active' }}>
    <div class="bucket {{ $state ? 'active' : 'in-active' }}">
        <div class="window-controls">
            <i class="bi bi-x-lg bold close" wire:click="$set('state',0)"></i>
        </div>
        <div class="main">
            {{-- Image --}}
            <div class="image">
                <img src="{{ App\Http\Controllers\MediaController::serveImage('product-' . $id, 'webp') }}"
                    alt="" />
            </div>
            {{-- Id --}}
            <div class="id">
                {{-- Available --}}
                <p class="pill available {{ $available ? 'in-stock' : 'out-stock' }} bold">
                    {{ $available ? 'In Stock' : 'Out of Stock' }}
                </p>
                {{-- Category --}}
                <p>{{ $category }}</p>
                {{-- Tags --}}
                <div class="tags">
                    @if ($tags)
                        @foreach ($tags as $tag)
                            <small class="tag tag-{{ $tag['tag'] }}">
                                <p>{{ $tag['tag'] }}</p>
                            </small>
                        @endforeach
                    @endif
                </div>
                {{-- Title and description --}}
                <div class="identifier">
                    <h5><span class="bold">{{ $provider }}</span> {{ $name }}</h5>
                    <p class="description">{{ $description }}</p>
                </div>
            </div>
            {{-- Actions --}}
            <div class="actions">
                {{-- Options --}}
                <div class="options">
                    @if ($options)
                        <select size="1" wire:model.live="selectedOpt" name="options"
                            class="options-{{ $id }}">
                            <option value={{ $selectedOpt }}>
                                {{ $selectedOpt == 'x' ? 'Check Options' : $options[$selectedOpt]['option'] }}
                            </option>
                            <option value="x">
                                Check Options
                            </option>
                            @for ($x = 0; $x < sizeof($options); $x++)
                                <option value="{{ $x }}">{{ $options[$x]['option'] }}</option>
                            @endfor
                        </select>
                    @endif
                </div>
                {{-- Prices --}}
                <div class="prices">
                    @if ($prices)
                        @for ($x = 0; $x < sizeof($prices); $x++)
                            <div wire:click="$set('selectedPri',{{ $x }})"
                                class="price pill {{ $selectedPri == $x ? 'active' : '' }}">
                                ${{ $prices[$x]['value'] }}
                                /{{ $prices[$x]['metric'] }} </div>
                        @endfor
                    @endif
                </div>
                {{-- Buttons --}}
                <div class="buttons">
                    <button class="remove" wire:click="removeAll()"><i class="bi bi-trash h5"></i></button>
                    <div class="cart">
                        {{-- Minus --}}
                        @if ($quantity > 0)
                            <div class="minus {{ $quantity > 0 ? 'active' : '' }}" wire:click="addToCart('-')"><i
                                    class="bi bi-dash-lg h5"></i></div>
                        @endif
                        {{-- Quantity --}}
                        @if ($quantity > 0)
                        <p class="quantity"> {{ $quantity }}</p>
                        @endif
                        {{-- Add --}}
                        <div class="add {{ $quantity > 0 ? 'add-active' : '' }}" wire:click="addToCart('+')">
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
