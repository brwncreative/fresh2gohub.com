<div class='feature-product-bucket'>
    {{-- Custom Styling --}}
    @if ($chunk == 0)
        <style>
            .bi-chevron-left {
                opacity: .5;
            }
        </style>
    @endif
    @if ($this->chunk == $this->products['size'] - 1)
        <style>
            .bi-chevron-right {
                opacity: .5;
            }
        </style>
    @endif

    {{-- Controls --}}
    <div class="controls">
        <div class="text">
            <h4 class="bold">See whats popular</h4>
            <p>Explore what's going fast</p>
        </div>
        <div class="actions">
            <i class="bi bi-chevron-left h4" wire:click="setChunk('-')"></i>
            <i class="bi bi-chevron-right h4" wire:click="setChunk('+')"></i>
        </div>
    </div>
    {{-- Products --}}
    <div class="products">
        @foreach ($products['chunk'] as $product)
            <livewire:products.product-card :key="$product->id" :id="$product->id" :tags="$product->tags" :provider="$product->provider"
                :name="$product->name" :description="$product->description" :options="$product->options" :prices="$product->prices" :available="$product->available"
                :category="$product->category"></livewire:products.product-card>
        @endforeach
    </div>
</div>
