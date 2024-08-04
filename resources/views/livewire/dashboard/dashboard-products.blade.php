<div id="products-container">
    <div id="products-list" class="center">
        <div id="pl-wrapper" class="center">
            <div id="pl-tb-wrapper">
                <table table-layout:fixed>
                    <tr>
                        <th width=100>name</th>
                        <th width=100>description</th>
                        <th width=100>tags</th>
                        <th width=70>in-stock</th>
                        <th width=100>stock</th>
                        <th width=100>options</th>
                        <th width=80>price</th>
                        <th width=80>actions</th>
                    </tr>
                    @foreach ($products as $product)
                        <tr>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->description }}</td>
                            <td>{{ $product->tags }}</td>
                            <td>
                                {{ $product->in_stock ? 'yes' : 'no' }}
                            </td>
                            <td>{{ $product->stock }}</td>
                            <td>{{ $product->options }}</td>
                            <td>{{ $product->price }}</td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
    <div id="product-form" class="center">
        <div id="pf-wrapper" class="center">
            <form wire:submit='create'>
                <h1>Product Form</h1>
                <div class=""><input type="file" title="product image" wire:model="image" id="upload"></div>
                <div class="input center"><input placeholder="Name" wire:model='name' name="name"></div>
                <div class="input center"><input placeholder="Description" wire:model='description' name="description">
                </div>
                <div class="input center"><input placeholder="tags" wire:model.live.debounce.150ms='tags'
                        name="tags"></div>
                {{-- Rendered Tags  --}}
                <div id="tags">
                    @foreach ($tagGroup as $tag)
                        <div class='tag tag-{{ $tag }}'> {{ $tag }} </div>
                    @endforeach
                </div>
                <div class="">
                    <label for="in_stock">In Stock</label>
                    <input placeholder="In Stock" wire:model='in_stock'type="checkbox" name="in_stock" id="in_stock">
                </div>
                <div class="input center"><input placeholder="Stock" wire:model='stock' type="number" name="stock">
                </div>
                <div class="input center"><input placeholder="Options" wire:model='options' name="options"></div>
                <div class="input center"> <input placeholder="Price" step="0.01" wire:model='price' type="number"
                        name="price"></div>
                <div class="input center"><input placeholder="metric" wire:model='metric' name="metric"></div>
                <div class="center"><button type="submit">Add Product</button></div>
            </form>
        </div>
    </div>
</div>
