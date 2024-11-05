<div class="product-card">
    @if ($type == 'list')
        <style>
            .product-card {
                margin-bottom: 2.5rem;
                display: flex;
                flex: 0 25%;

                @media only screen and (max-width: 1070px) {
                    flex: 0 50%;
                }
            }

            @media only screen and (max-width: 1070px) {
                .product-card {
                    border: none;
                }

                .product-card:nth-child(odd) {
                    padding-left: 0rem;
                    padding-right: 0.8rem;
                }

                .product-card:nth-child(even) {
                    padding-left: 0.8rem;
                    padding-right: 0rem;
                }
            }
        </style>
    @endif
    <div class="pc-bucket" style="{{ $type == 'list' ? 'width:100%' : '' }}">
        {{-- Image --}}
        <div class="image" wire:click="callPage('{{ $id }}')">
            <img src="{{ App\Http\Controllers\MediaController::serveImage('product-' . $id, 'webp') }}" alt="" />
        </div>
        {{-- Tags --}}
        <div class="tags">
            @foreach ($tags as $tag)
                <small class="tag">
                    <p>{{ $tag->tag }}</p>
                </small>
            @endforeach
        </div>
        {{-- ID --}}
        <div class="identifiers" wire:click="callPage({{ $id }})">
            <p class="provider">{{ $provider }}</p>
            <p class="name bold">{{ $name }}</p>
        </div>
        {{-- Options --}}
        <div class="options">
            <select size="1" wire:model.live="selectedOpt" name="options" class="options-{{ $id }}">
                <option value={{ $selectedOpt }}>
                    {{ $selectedOpt == 'x' ? 'Check Options' : $options[$selectedOpt]->option }}
                </option>
                <option value="x">
                    Check Options
                </option>
                @for ($x = 0; $x < sizeof($options); $x++)
                    <option value="{{ $x }}">{{ $options[$x]->option }}</option>
                @endfor
            </select>
        </div>
        {{-- Prices --}}
        <div class="prices">
            @for ($x = 0; $x < sizeof($prices); $x++)
                <div wire:click="$set('selectedPri',{{ $x }})"
                    class="price pill {{ $selectedPri == $x ? 'active' : '' }}">${{ $prices[$x]->value }}
                    /{{ $prices[$x]->metric }} </div>
            @endfor
        </div>
        {{-- Actions --}}
        <div class="actions">
            <div class="buttons {{ $quantity > 0 ? 'active' : '' }}">
                @if ($quantity > 0)
                    <button wire:click="handleCart('-')" class="remove">
                        <i class="bi bi-dash-lg h5"></i>
                    </button>
                    <p class="quantity">{{ $quantity }}</p>
                @endif
                <button wire:click="handleCart('+')" class="add">
                    @if ($quantity > 0)
                        <i class="bi bi-plus-lg h5"></i>
                    @else
                        <i class="bi bi-basket h5"></i>
                    @endif
                </button>
            </div>
        </div>
    </div>
</div>
