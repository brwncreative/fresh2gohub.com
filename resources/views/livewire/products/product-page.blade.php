<div id="product-page" style="{{ $state ? 'pointer-events: all' : '' }}">
    @script
        <script>
            document.addEventListener("keydown", (event) => {
                if (event.key == 'Escape') {
                    $wire.$toggle('state');
                }
            });
        </script>
    @endscript
    <div class="bucket {{ $state ? 'active' : 'in-active' }}">
        {{-- Image --}}
        <div class="image">
            <div class="lazy-load"></div>
        </div>
        {{-- Id --}}
        <div class="id">
            <p>{{ $category }}</p>
            <span class="tags">
                @if ($tags)
                    @foreach ($tags as $tag)
                        <small class="tag">
                            <p>{{ $tag['tag'] }}</p>
                        </small>
                    @endforeach
                @endif
            </span>
            <p class="medium-title">{{ $provider }} : <span class="bold">{{ $name }}</span></p>
            <p class="description">{{ $description }}</p>
            <div class="options">
                @if ($options)
                    <select wire:model.live='selectedOpt' class="option-{{ $id }}" name="options">
                        <option value='{"option":"Check Options", "value":0}'>Check Options</option>
                        @foreach ($options as $option)
                            <option value="{{ json_encode($option) }}">{{ $option['option'] }}</option>
                        @endforeach
                    </select>
                @endif

                @if ($prices)
                    <select wire:model.live="selectedPri" class="price-{{ $id }}" name="prices">
                        @foreach ($prices as $price)
                            <option value="{{ json_encode($price) }}">{{ $price['value'] }} / {{ $price['metric'] }}
                            </option>
                        @endforeach
                    </select>
                @endif

            </div>
            <p class="{{ $available ? 'in-stock' : 'out-stock' }} bold">{{ $available ? 'In Stock' : 'Out of Stock' }}
            </p>
        </div>
        {{-- Actions --}}
        <div class="actions">
            <button class="remove"><i class="bi bi-trash"></i></button>
            <button class="minus"><i class="bi bi-dash-lg"></i></button>
            <button class="add"><i class="bi bi-bag-plus-fill"></i></button>

            <div class="quantity">
                <p>{{ $quantity }}</p>
            </div>

        </div>
    </div>
</div>
