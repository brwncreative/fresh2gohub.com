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
            <h5 class="bold">See whats popular</h5>
            <p class="bold paragraph">These are going fast</p>
        </div>
        <div class="actions">
            <i class="bi bi-chevron-left h4" wire:click="setChunk('-')"></i>
            <i class="bi bi-chevron-right h4" wire:click="setChunk('+')"></i>
        </div>
    </div>
    {{-- Products --}}
    <div class="products">
        @foreach ($products['chunk'] as $product)
            <livewire:products.product-card lazy :key="$product->id" :id="$product->id" :tags="$product->tags" :provider="$product->provider"
                :name="$product->name" :description="$product->description" :options="$product->options" :prices="$product->prices" :available="$product->available"
                :category="$product->category"></livewire:products.product-card>
        @endforeach
    </div>
    {{-- Card Wide JS --}}
    @script
        <script>
            // Create a MediaQueryList object
            mobile = window.matchMedia("(max-width: 1070px)")
            // Initial call
            if (mobile.matches) {
                $wire.set('limit', '2');
                $wire.call('grab');
            } else if ($wire.get('limit') == 2) {
                $wire.set('limit', '4');
                $wire.call('grab');
            }
            // Attach listener function on state changes
            mobile.addEventListener("change", function() {
                if (mobile.matches) {
                    $wire.set('limit', '2');
                    $wire.call('grab');
                } else if ($wire.get('limit') == 2) {
                    $wire.set('limit', '4');
                    $wire.call('grab');
                }
            });
        </script>
    @endscript
</div>
