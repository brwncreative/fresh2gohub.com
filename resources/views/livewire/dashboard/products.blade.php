<main id="dashboard">
    <div id="products">
        @foreach ($products as $product)
            <div class="product">
                <div class="id">
                    {{-- Identity information --}}
                    <div class="information">
                        <div class="labels">
                            <p class="paragraph">Id:</p>
                            <p class="paragraph">Name:</p>
                            <p class="paragraph">Tags:</p>
                            <p class="paragraph">Category:</p>
                            <p class="paragraph">Description:</p>
                            <p class="paragraph">In Stock:</p>
                            <p class="paragraph">Stock:</p>
                        </div>
                        <div class="content">
                            <p class=" paragraph-reg "> {{ $product->id }}</p>
                            <p class="bold"> {{ $product->provider }} - <span
                                    class="bold">{{ $product->name }}</span></p>
                            <span class="tags paragraph-reg ">
                                @foreach ($product->tags as $tag)
                                    <p class="tag-{{ $tag->tag }}">{{ $tag->tag }}</p>
                                @endforeach
                            </span>
                            <p class=" paragraph-reg "> {{ $product->category }}</p>
                            <p class=" paragraph-reg "> {{ $product->description }}</p>
                            <p class=" paragraph-reg available-{{ $product->available ? 'yes' : 'no' }}">
                                {{ $product->available ? 'yes' : 'no' }}
                            </p>
                            <p class=" paragraph-reg "> {{ $product->stock }}</p>
                        </div>
                    </div>
                    {{-- Options and Prices --}}
                    <div class="options-prices">
                        @foreach ($product->options as $option)
                            <div class="option">
                                <p class="paragraph-reg">{{ $option->option }} -> ${{ $option->value }}</p>
                            </div>
                        @endforeach

                        @foreach ($product->prices as $price)
                            <div class="price">
                                <p class="paragraph-reg">${{ $price->value }} / {{ $price->metric }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
                {{-- Analytis --}}

                {{-- Actions --}}
                <div class="actions">
                    <button wire:click='letsUpdate({{ $product->id }})'><small>Update</small></button>
                    <button class="delete-btn" wire:click='remove({{ $product->id }})'><i
                            class="bi bi-trash"></i></button>
                </div>
            </div>
        @endforeach
    </div>

    {{-- Product Form --}}
    <div id="form">
        <div class="bucket">
            <div id="searchbar">
                <input type="text" placeholder="Find Products">
                <div class="search-actions">
                    <i class="bi bi-binoculars"></i>
                </div>
            </div>
            {{-- Create Product --}}
            <form wire:submit='create'>
                <div id="form-inputs">
                    <select class="category-select" wire:model.live='category'>
                        <option value="Category">Category</option>
                        <option value="mixed packages">mixed packages</option>
                        <option value="vegetables">vegetables</option>
                        <option value="prepackaged fruits and platters">prepackaged fruits and platters</option>
                        <option value="mash">mash</option>
                        <option value="sauces">sauces</option>
                        <option value="seasonings">seasonings</option>
                        <option value="dry rubs(packs)">dry rubs(packs)</option>
                        <option value="meats">meats</option>
                        <option value="seafood">seafood</option>
                        <option value="marinades">marinades</option>
                    </select>
                    @script
                        <script>
                            $wire.set('category', document.querySelector(".category-select").value)
                        </script>
                    @endscript
                    <input wire:model='provider' type="text" placeholder="Provider">
                    <input wire:model='name' type="text" placeholder="Name">
                    <input wire:model='description' type="text" placeholder="Description">
                    <p class="paragraph">Hint: Type it like this -> "popular , healthy, delivery"</p>
                    <input wire:model.live='tags' type="text" placeholder="Tags">
                    <p class="paragraph">Hint: Type it like this -> "2 for one/12.99 , Christmas deal/24.99"</p>
                    <input wire:model.live='options' type="text" placeholder="Options">
                    <p class="paragraph">Hint: Type it like this -> '9.99/bag , 12.50/bundle'</p>
                    <input wire:model.live='prices' type="text" placeholder="Prices">
                    <select class="stock-select" wire:model.live='available' placeholder="In Stock">
                        <option value=1>In Stock</option>
                        <option value=0> Out of Stock</option>
                    </select>
                    @script
                        <script>
                            $wire.set('available', document.querySelector(".stock-select").value)
                        </script>
                    @endscript
                    <input wire:model='stock' type="text" placeholder="Stock">
                </div>
                <button>Add Product</button>
            </form>
            {{-- --- --}}
        </div>
    </div>
</main>
