<div class="product-card">
    {{-- Image --}}
    <div class="image" wire:click='callPage({{$id}})'><img src="" alt="">
        <div></div>
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
    <div class="identifiers" wire:click='callPage({{$id}})'>{{ $provider }} : <span
            class="small-title">{{ $name }}</span></div>
    <div class="description paragraph">{{ $description }}</div>
    {{-- Options --}}
    <div class="options">
        <select wire:model.live='selectedOpt' class="option-{{ $id }}" name="options">
            <option value='{"option":"Check Options", "value":0}'>Check Options</option>
            @foreach ($options as $option)
                <option value="{{ $option }}">{{ $option->option }}</option>
            @endforeach
        </select>
        @script
            <script>
                $wire.set('selectedOpt', document.querySelector(".option-{{ $id }}").value)
            </script>
        @endscript
    </div>
    {{-- Prices and Actions --}}
    <div class="main-actions">
        <div class="prices">
            <select wire:model.live="selectedPri" class="price-{{ $id }}" name="prices">
                @foreach ($prices as $price)
                    <option value="{{ $price }}">{{ $price->value }} / {{ $price->metric }}</option>
                @endforeach
            </select>
            @script
                <script>
                    $wire.set('selectedPri', document.querySelector(".price-{{ $id }}").value)
                </script>
            @endscript
        </div>
        <div class="btns">
            <i class="bi bi-dash-circle minus h5" wire:click="addToCart('-')"></i>
            <p>
                {{ $quantity }}
            </p>
            <i class="bi bi-plus-circle add h5" wire:click="addToCart('+')"></i>
        </div>
    </div>
</div>
