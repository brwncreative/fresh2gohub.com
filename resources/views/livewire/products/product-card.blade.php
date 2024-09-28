<div class="product-card">
    @if ($type == 'list')
        <style>
            .product-card {
                display: flex;
                flex: 0 25%;

                @media only screen and (max-width: 1070px) {
                    flex: 0 50%;
                }
            }

            @media only screen and (max-width: 1070px) {
                .product-card {
                    border: none;
                }

                .product-card:nth-child(odd) {
                    padding-left: 0rem;
                    padding-right: 0.8rem;
                }

                .product-card:nth-child(even) {
                    padding-left: 0.8rem;
                    padding-right: 0rem;
                }
            }
        </style>
    @endif

    <div class="pc-bucket" style="{{ $type == 'list' ? 'width:100%' : '' }}">
        {{-- Image --}}
        <div class="image" wire:click="callPage('{{ $id }}')">
            <div>
                <img src="{{ App\Http\Controllers\MediaController::serveImage('product-' . $id, 'webp') }}"
                    alt="" />
            </div>
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
        <div class="identifiers" wire:click="callPage({{ $id }})">
            {{ $provider }} : <span class=" bold">{{ $name }}</span>
        </div>
        <div class="description paragraph">{{ $description }}</div>
        {{-- Options --}}
        <div class="options">
            <select wire:model.live="selectedOpt" class="option-{{ $id }}" name="options">
                <option value='{"option":"Check Options", "value":0}'>
                    Check Options
                </option>
                @foreach ($options as $option)
                    <option value="{{ $option }}">{{ $option->option }}</option>
                @endforeach
            </select>
            <div class="option-icon center">
                <i class="bi bi-chevron-right arrow arrow-{{ $id }}"></i>
            </div>
            @script
                <script>
                    const options = document.querySelector(".option-{{ $id }}");
                    const arrow = document.querySelector(".arrow-{{ $id }}");
                    options.addEventListener("focus", (e) => {
                        arrow.style.transform = "rotate(90deg)";
                    });
                    options.addEventListener("focusout", (e) => {
                        arrow.style.transform = "rotate(0deg)";
                    });
                </script>
                @endscript @script
                <script>
                    $wire.set(
                        "selectedOpt",
                        document.querySelector(".option-{{ $id }}").value
                    );
                </script>
            @endscript
        </div>
        {{-- Prices and Actions --}}
        <div class="main-actions">
            <div class="prices">
                <select wire:model.live="selectedPri" class="price-{{ $id }}" name="prices">
                    @foreach ($prices as $price)
                        <option value="{{ $price }}">
                            ${{ $price->value }} / {{ $price->metric }}
                        </option>
                    @endforeach
                </select>
                @script
                    <script>
                        $wire.set(
                            "selectedPri",
                            document.querySelector(".price-{{ $id }}").value
                        );
                    </script>
                @endscript
            </div>
            <div class="btns">
                <span>
                    @if ($quantity >= 1)
                        <i class="bi bi-dash-circle minus h4" wire:click="addToCart('-')"></i>
                    @endif
                </span>
                <p style="pointer-events: none">
                    @if ($quantity >= 1)
                        {{ $quantity }}
                    @endif
                </p>
                <i class="bi bi-plus-circle add h4" wire:click="addToCart('+')"></i>
            </div>
        </div>
    </div>
</div>
