<div id="dashboard">
    <div class="greeting">
        <h2 class="bold">Products</h2>
        <p class="pargraph">Products management section. Choose a category and click the funnel to filter</p>
        <div id="filters">
            <i class="bi bi-funnel h4" wire:click="$toggle('filtering')"></i>
            <select id="filter-category" wire:model='search'>
                <option value="category"> Category</option>
                @foreach ($categories as $option)
                    <option value="{{ $option }}"> {{ $option }}</option>
                @endforeach
            </select>
        </div>
        <hr>
    </div>
    <div id="products">
        <div id="new" class="product-card">
            <div class="bucket">
                {{-- Bar --}}
                <div class="bar" wire:click="$toggle('creating')">
                    <div class="text">
                        <h5>New Product</h5>
                    </div>
                    <div class="icon"><i class="bi bi-plus h3"></i></div>
                </div>
                {{-- Form --}}
                <div class="form {{ $creating ? 'active' : '' }}">
                    <div class="image">
                        <div class="image-container">
                            <img src="{{ $image ? $image->temporaryUrl() : '' }}" alt="">
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

                        <p>Description: </p>
                        <div class='field'>
                            <textarea wire:model='description' placeholder="Product Description"></textarea>
                        </div>

                        <p>Stock: </p>
                        <div class='field'><input type="text" wire:model='stock' placeholder="Stock"></div>

                        <p>Available</p>
                        <div class='field' style="flex-direction: row">
                            <div class="toggle {{ $available ? 'toggle-active' : '' }}"
                                wire:click="$toggle('available')">
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
                            <div class="inputs"> <input wire:model.live='tagString'
                                    wire:keydown.space="handleTag('add')" type="text" placeholder="Tags"> </div>
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
                        <button wire:click="$toggle('creating')"> Cancel</button>
                        <button wire:click='create'>Add</button>
                        <input wire:model='image' type="file" id="filebtn-hidden" hidden>
                        @if (strlen($name) > 5)
                            <label for="filebtn-hidden"> <i class="bi bi-camera"></i> Upload </label>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <hr>
        @if (sizeof($products['chunk']) > 0)
            @foreach ($products['chunk'] as $product)
                <livewire:dashboard.helpers.product-card :key="$product->id" :product="$product" :categories="$categories"
                    @saved="update"></livewire:dashboard.helpers.product-card>
            @endforeach
        @else
            <h4>No Products in this category</h4>
            <h6>Add a few and they'll be here for you</h6>
        @endif
        <div id="pagination-controls">
            @for ($x = 0; $x < $products['size']; $x++)
                <p class="{{ $chunk == $x ? 'active' : '' }}" wire:click="prepProducts({{ $x }})">
                    {{ $x + 1 }}</p>
            @endfor
        </div>
    </div>
</div>
