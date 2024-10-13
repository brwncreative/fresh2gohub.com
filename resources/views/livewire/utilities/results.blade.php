<main id="results">
    <div class="bucket">
        {{-- Filters --}}
        <div id="filters">
            <h5>Filters</h5>
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
                <h3 class="bold title">{{ $find ? $find : 'Click an option!' }}</h3>
                <p class="paragraph ">Lets see what we have here...</p>
            </div>
            <div id="product-container">
                @if ($filter == false)
                    @if ($products)
                        @foreach ($products['chunk'] as $product)
                            <livewire:products.product-card type="list" :key="$product->id" :id="$product->id"
                                :tags="$product->tags" :provider="$product->provider" :name="$product->name" :description="$product->description"
                                :options="$product->options" :prices="$product->prices" :available="$product->available"
                                :category="$product->category"></livewire:products.product-card>
                        @endforeach
                        {{-- Pagination Controls --}}
                        <div id="pagination">
                            @for ($x = 0; $x < $products['size']; $x++)
                                <p class="page" wire:click="move({{ $x }})"> {{ $x + 1 }}</p>
                            @endfor
                        </div>
                    @else
                        <p class="small-title">We'll have this for you soon!</p>
                    @endif
                @else
                    @if ($filteredProducts)
                        @foreach ($filteredProducts['chunk'] as $product)
                            <livewire:products.product-card type="list" :key="$product->id" :id="$product->id"
                                :tags="$product->tags" :provider="$product->provider" :name="$product->name" :description="$product->description"
                                :options="$product->options" :prices="$product->prices" :available="$product->available"
                                :category="$product->category"></livewire:products.product-card>
                        @endforeach
                        {{-- Pagination Controls --}}
                        <div id="pagination">
                            @for ($x = 0; $x < $filteredProducts['size']; $x++)
                                <p class="page" wire:click="move({{ $x }})"> {{ $x + 1 }}</p>
                            @endfor
                        </div>
                    @else
                        <p class="small-title">We'll have this for you soon!</p>
                    @endif
                @endif
            </div>

        </div>
    </div>
</main>
