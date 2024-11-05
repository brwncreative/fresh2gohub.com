<div id="results">
    <div class="bucket">
        {{-- Filters --}}
        <div id="filters">
            <h6>Filters</h6>
            <hr>
            <div id="filter-container">
                <div id="priceRange">
                    <p>Price: ${{ $price }}</p>
                    <input type="range" wire:model.live='price'min="0" max="200"></input>
                </div>
            </div>
            <div id="actions">
                <button wire:click="prepFilters('filter')" class="bold">Filter</button>
                @if ($filter)
                    <button wire:click="prepFilters('none')"class="bold"><i class="bi bi-x-lg bold"></i></button>
                @endif
            </div>
        </div>
        {{-- Products --}}
        <div id="products">
            <div class="text">
                <h4 class="bold title">{{ $find ? $find : 'Click an option!' }}</h4>
                <p class="paragraph ">Lets see what we have here...</p>
            </div>
            <div id="product-container">
                @if ($products['size'] > 0)
                    @foreach ($products['chunk'] as $product)
                        <livewire:products.product-card lazy type="list" :key="$product->id" :id="$product->id"
                            :tags="$product->tags" :provider="$product->provider" :name="$product->name" :description="$product->description" :options="$product->options"
                            :prices="$product->prices" :available="$product->available" :category="$product->category"></livewire:products.product-card>
                    @endforeach
                    {{-- Pagination Controls --}}
                    <div id="pagination">
                        @for ($x = 0; $x < $products['size']; $x++)
                            <p class="page {{ $products['position'] == $x ? 'active' : '' }}"
                                wire:click="move({{ $x }})"> {{ $x + 1 }}</p>
                        @endfor
                    </div>
                @else
                    <h5>We'll have this for you soon!</h5>
                @endif
            </div>
        </div>
    </div>
</div>
