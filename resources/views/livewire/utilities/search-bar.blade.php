<div class="bucket center">
    <input wire:model.live='find' wire:keydown.enter='search' type="search"
        placeholder="Lets get you something to eat!"></input>
    <div wire:click='search' id="sb-actions">
        <div class="search-btn"> <i class="bi bi-search h5"></i></div>
    </div>
    @if (strlen($find) > 0)
        <div id="results">
            <div id="results-container">
                @foreach ($products as $product)
                <span wire:click="search('{{$product->name}}')" class="result">
                   <p>{{$product->provider}} - {{$product->name}}</p>
                   <p style="color:{{$product->available ? 'green' : 'red'}}">{{$product->available ? 'in stock' : 'out of stock'}}</p>
                   <i class="bi bi-arrow-up-right"></i>
                </span>
                @endforeach
            </div>
        </div>
    @endif
</div>
