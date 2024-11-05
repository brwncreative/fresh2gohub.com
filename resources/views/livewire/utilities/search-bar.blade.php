<div class="bucket">
    {{-- Input --}}
    <input wire:model.live='find' wire:keydown.enter='search' type="search"
        placeholder="Lets get you something to eat!"></input>
    {{-- Icon --}}
    <div wire:click='search' class="search-icon">
        <div class="search-btn"> <i class="bi bi-search h6"></i></div>
    </div>
    @if (strlen($find) > 0)
        <div id="results">
            <div class="result-bucket">
                @foreach ($products as $product)
                    <span wire:click="search('{{ $product->name }}')" class="result">
                        <div class="info">
                            {{-- Provider --}}
                            <p class="provider">
                                {{ $product->provider }}
                            </p>
                            {{-- Name --}}
                            <p class="name">
                                {{ $product->name }}
                            </p>
                            {{-- Available --}}
                            <p class="available" style="color:{{ $product->available ? 'green' : 'red' }}">
                                {{ $product->available ? 'in stock' : 'out of stock' }}</p>
                        </div>
                        <i class="center bi bi-arrow-up-right"></i>
                    </span>
                @endforeach
            </div>
        </div>
    @endif
</div>
