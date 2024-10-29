<div class="product-card">
    @if ($type == 'list')
        <style>
            .product-card {
                margin-bottom: 2.5rem;
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
            <span class="bold"> {{ $provider }} : {{ $name }}</span>
        </div>
        <div class="description paragraph">{{ $description }}</div>
        {{-- Row: Options --}}
        <div class="choices">
            {{-- Options --}}
            <div class="options">
                <select wire:model.live="selectedOpt" class="option-{{ $id }}" name="options">
                    <option value="{{ $optPlaceholder['value'] }}">
                        {{ $optPlaceholder['option'] }}
                    </option>
                    <option value='{"option":"Check Options", "value":0}'>
                        Check Options
                    </option>
                    @foreach ($options as $option)
                        <option value="{{ $option }}">{{ $option->option }}</option>
                    @endforeach
                </select>
                <div class="option-icon">
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
                @endscript
                {{-- @script
                     <script>
                        $wire.set(
                            "selectedOpt",
                            document.querySelector(".option-{{ $id }}").value
                        );
                    </script>
                @endscript --}}
            </div>
        </div>
        {{-- Row: Prices and Actions --}}
        <div class="actions">
            {{-- Prices --}}
            <div class="prices">
                <select wire:model.live="selectedPri" class="price-{{ $id }}" name="prices">
                    <option value="{{ $priPlaceholder['value'] }}">
                        {{ $priPlaceholder['price'] }}
                    </option>
                    @foreach ($prices as $price)
                        <option value="{{ $price }}">
                            ${{ $price->value }} / {{ $price->metric }}
                        </option>
                    @endforeach
                </select>
                {{-- @script
                    <script>
                        $wire.set(
                            "selectedPri",
                            document.querySelector(".price-{{ $id }}").value
                        );
                    </script>
                @endscript --}}
            </div>
            <div class="btns">
                <div wire:click="addToCart('-')"
                    class="click minus-container {{ $quantity > 0 ? 'minus-active' : '' }}"><i
                        class=" bi bi-dash minus h5 {{ $quantity > 0 ? 'active' : '' }}"></i></div>
                <div wire:click="addToCart('+')" class="click add-container {{ $quantity > 0 ? 'add-active' : '' }}">
                    @if ($quantity > 0)
                        <p>{{ $quantity }}</p>
                        <i class="bi bi-plus-lg h5 {{ $quantity > 0 ? 'active' : '' }}"></i>
                    @else
                        <i class=" bi bi-basket add h5 {{ $quantity > 0 ? 'active' : '' }}"></i>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
