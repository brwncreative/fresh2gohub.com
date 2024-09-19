<main id="results">
    <div class="bucket">
        <div id="filters">
            <p>Filters</p>
            <hr>
            <div id="filter-container">
                <div id="priceRange">
                    <p>Price: ${{ $price }}</p>
                    <input type="range" wire:model.blur='price'min="0" max="30"></input>
                </div>
            </div>
            <div id="actions">
                <button wire:click="prepFilters('filter')" class="bold">Filter</button>
                @if ($filter)
                    <button wire:click="prepFilters('none')"class="bold"><i class="bi bi-x-lg bold"></i></button>
                @endif
            </div>
        </div>
        <div id="products">
            <div>
                <p class="medium-title">{{ $find ? $find : 'Click an option!' }}</p>
                <p class="paragraph bold">Lets see what we have here..</p>
            </div>
            @if (count($products) > 0)
            <div id="product-container">
                @foreach ($products as $product)
                    <livewire:products.product-card type="list" :key="$product->id" :id="$product->id" :tags="$product->tags"
                        :provider="$product->provider" :name="$product->name" :description="$product->description" :options="$product->options" :prices="$product->prices"
                        :available="$product->available" :category="$product->category"></livewire:products.product-card>
                @endforeach
            </div>
            @else
            <p class="small-title">We'll have this for you soon!</p>
            @endif
           
        </div>
    </div>
</main>
