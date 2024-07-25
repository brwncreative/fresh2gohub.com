<div id="s-wrapper" class="center">
    <div id="s-bar" class="center">
        <form action="">
            @csrf <!-- {{ csrf_field() }} -->
            <div id="s-container"> <input placeholder="Lets eat!" name="search" wire:model.live="type"
                    wire:change="clickAway()" type="search"></input>
                <div id="s-btn" class="center"><i class="bi bi-search h2"></i>
                </div>
            </div>
        </form>
    </div>
    {{-- @if (sizeof($products) > 0)
        <div id="s-results-wrapper">
            <div id="s-results">
                @foreach ($products as $product)
                    <div class="result">
                        <p>{{ $product->item_name }}</p>
                        <small>{{ $product->description }}</small>
                    </div>
                @endforeach
            </div>
        </div>
    @endif --}}
</div>
