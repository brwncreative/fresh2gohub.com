<div id="products-container">
    <div id="products-list">
        <div id="pl-wrapper">
            <table>
                <tr id="pl-headings">
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
    <div id="product-form" class="center">
        <div id="pf-wrapper">
            <form wire:submit='create'>
                <input type="file" wire:model="image">
                <input placeholder="Name" wire:model='name' name="name">
                <input placeholder="Description" wire:model='description' name="description">
                <input placeholder="tags" wire:model.live.debounce.150ms='tags' name="tags">
                {{-- Rendered Tags --}}
                <div id="tags">
                    @foreach ($tagGroup as $tag)
                        <div class='tag tag-{{ $tag }}'> {{ $tag }} </div>
                    @endforeach
                </div>
                <div><label for="in_stock">In Stock</label>
                    <input placeholder="In Stock" wire:model='in_stock'type="checkbox" name="in_stock">
                </div>
                <input placeholder="Stock" wire:model='stock' type="number" name="stock">
                <input placeholder="Options" wire:model='options' name="options">
                <input placeholder="Price" step="0.01" wire:model='price' type="number" name="price">
                <button type="submit">Add Product</button>
            </form>
        </div>
    </div>
</div>
