<div class="product-card">
    <div class="bucket">
        <div class="form active">
            <div class="image">
                <div class="image-container">
                    <img src="{{ App\Http\Controllers\MediaController::serveImage('product-' . $product->id, 'webp') }}"
                        alt="">
                </div>
            </div>
            <div class="inputs">
                <p>Provider: </p>
                <div class='field'><input type="text" wire:model='provider'></div>

                <p>Name:</p>
                <div class='field'><input type="text" wire:model.blur='name' placeholder="Name"></div>

                <p>Category:</p>
                <div class='field'><select name="Categories" class="select-category" wire:model='category'>
                        <option value="category">Category</option>
                        @foreach ($categories as $option)
                            <option value="{{ $option }}">{{ $option }}</option>
                        @endforeach
                    </select></div>
                @script
                    <script>
                        $wire.set(
                            "category",
                            document.querySelector("select-category-{{ $product->id }}").value
                        );
                    </script>
                @endscript
                <p>Description: </p>
                <div class='field'>
                    <textarea wire:model='description' placeholder="Product Description"></textarea>
                </div>

                <p>Stock: </p>
                <div class='field'><input type="text" wire:model='stock' placeholder="Stock"></div>

                <p>Available</p>
                <div class='field' style="flex-direction: row">
                    <div class="toggle {{ $available ? 'toggle-active' : '' }}" wire:click="$toggle('available')">
                        <div class="thumb {{ $available ? 'thumb-active' : '' }}"></div>

                    </div>
                    <p>{{ $available ? 'in stock' : 'out of stock' }}</p>
                </div>
                {{-- Tags --}}
                <p>Tags</p>
                <div class='field'>
                    <div class="tags">
                        {{-- Pills --}}
                        @for ($x = 0; $x < sizeof($tags); $x++)
                            @if (array_key_exists($x, $tags))
                                @if (strlen($tags[$x]) > 1)
                                    <div class="tag pill"><i class="bi bi-x del"
                                            wire:click="handleTag('del',{{ $x }})"></i>
                                        {{ $tags[$x] }}
                                    </div>
                                @endif
                            @endif
                        @endfor
                    </div>
                    {{-- Tag Input --}}
                    <div class="inputs"> <input wire:model.live='tagString' wire:keydown.space="handleTag('add')"
                            type="text" placeholder="Tags"> </div>
                </div>
                {{-- Options --}}
                <p>Options</p>
                <div class='field'>
                    {{-- Pills --}}
                    <div class="options">
                        @for ($x = 0; $x < sizeof($options); $x++)
                            @if (array_key_exists($x, $options))
                                <div class="option pill"><i class="bi bi-x del"
                                        wire:click="handleOption('del',{{ $x }})"></i>
                                    {{ $options[$x]['option'] }} /
                                    ${{ number_format($options[$x]['value'], 2, '.', '') }}
                                </div>
                            @endif
                        @endfor
                    </div>
                    {{-- Input --}}
                    <div class="inputs">
                        <input type="text" placeholder="Option" wire:model='optionString'>
                        /
                        <input type="text" placeholder="Option Value" wire:model='optionValueString'>
                        <button wire:click="handleOption('add')">add</button>
                    </div>
                </div>
                <p>Prices</p>
                <div class='field'>
                    {{-- Prices --}}
                    <div class="prices">
                        {{-- Pills --}}
                        @for ($x = 0; $x < sizeof($prices); $x++)
                            @if (array_key_exists($x, $prices))
                                <div class="option pill"><i class="bi bi-x del"
                                        wire:click="handlePrice('del',{{ $x }})"></i>
                                    ${{ number_format($prices[$x]['value']) }} /
                                    {{ $prices[$x]['metric'] }}
                                </div>
                            @endif
                        @endfor
                    </div>
                    {{-- Input --}}
                    <div class="inputs">
                        <input type="text" placeholder="Price" wire:model='priceValueString'>
                        /
                        <input type="text" placeholder="Metric" wire:model='metricString'>
                        <button wire:click="handlePrice('add')">add</button>
                    </div>

                </div>
            </div>
            <div class="actions">
                <button wire:click='remove' class="remove"
                    wire:confirm="Are you sure you want to delete this product?"><i class="bi bi-trash"></i></button>
                <button wire:click='update'>Update</button>
                <button wire:click='removeImage'>Delete Image</button>
                <input wire:model='image' type="file" id="filebtn-hidden.{{ $product->id }}" hidden>
                <label for="filebtn-hidden.{{ $product->id }}"> <i class="bi bi-camera"></i> Upload image</label>
            </div>
        </div>
    </div>
</div>
