<div class="pcontainer">
    <div class="product">
        <div class="image">
            <div class="image-container">
                <img src="{{ App\Http\Controllers\MediaController::serveImage('product-' . $product->id, 'webp') }}"
                    alt="">
            </div>
        </div>
        <table class="product-details">
            <tbody>
                <tr>
                    <th style="width:6rem"></th>
                    <th></th>
                </tr>
                <tr>
                    <td class="paragraph">Id: {{ $product->id }}</td>
                </tr>
                <tr>
                    <td class="paragraph">Provider</td>
                    <td><input type="text" wire:model='provider'></td>
                </tr>
                <tr>
                    <td class="small-title">Name:</td>
                    <td><input type="text" wire:model='name'></td>
                </tr>
                <tr>
                    <td class="paragraph">Category:</td>
                    <td><input type="text" wire:model='category'></td>
                </tr>
                <tr>
                    <td class="paragraph">Descrip:</td>
                    <td>
                        <textarea wire:model='description'>{{ $product->description }}</textarea>
                    </td>
                </tr>
                <tr>
                    <td class="paragraph">Stock</td>
                    <td>
                        <input type="text" wire:model='stock'>
                    </td>
                </tr>
                <tr>
                    <td class="paragraph">Available</td>
                    <td class="toggle-available">
                        <div class="toggle {{ $available ? 'thumb-active' : '' }}" wire:click="$toggle('available')">
                            <div class="thumb"></div>
                        </div>
                        {{ $available ? 'in stock' : 'out of stock' }}
                    </td>
                </tr>
                <tr>
                    <td class="paragraph">Tags: </td>
                    @if ($editTags)
                        <td>
                            <input type="text" wire:model='tags'>
                        </td>
                    @else
                        <td class="tags" wire:click="$set('editTags',true)">
                            @foreach ($product->tags as $tag)
                                <p class="tag">{{ $tag->tag }}</p>
                            @endforeach
                        </td>
                    @endif
                </tr>
                <tr>
                    <td class="paragraph">Options: </td>
                    @if ($editOptions)
                        <td>
                            <input type="text" wire:model='options'>
                        </td>
                    @else
                        <td class="options" wire:click="$set('editOptions',true)">
                            @foreach ($product->options as $option)
                                <p class="option">{{ $option->option }} / ${{ $option->value }}</p>
                            @endforeach
                        </td>
                    @endif
                </tr>
                <tr>
                    <td class="paragraph">Prices: </td>
                    @if ($editPrices)
                        <td>
                            <input type="text" wire:model='prices'>
                        </td>
                    @else
                        <td class="prices" wire:click="$set('editPrices',true)">
                            @foreach ($product->prices as $price)
                                <p class="price">${{ $price->value }} / {{ $price->metric }}</p>
                            @endforeach
                        </td>
                    @endif
                </tr>
            </tbody>
        </table>
        <div class="buttons">
            <button wire:click='remove' class="remove"><i class="bi bi-trash"></i></button>
            <button wire:click='update'>Update</button>
            <button wire:click='removeImage'>Delete Image</button>
            <input wire:model='image' type="file" id="filebtn-hidden.{{ $product->id }}" hidden>
            <label for="filebtn-hidden.{{ $product->id }}"> <i class="bi bi-camera"></i> Upload image</label>
        </div>
    </div>
</div>
