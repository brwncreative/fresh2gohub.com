<main id="dashboard">
    <div id="products">
        @if ($creating)
            <style>
                #add-product {
                    opacity: 1;
                    display: grid;
                    grid-template: .5fr max-content max-content max-content/ 1fr;
                    gap: 0.5rem;

                    td {
                        font-size: 0.9rem;

                        .thumb-active {
                            background-color: rgba(0, 128, 0, .5) !important;
                            justify-content: end !important;
                        }

                        .toggle {
                            padding-inline: .2rem;
                            display: flex;
                            border-radius: 10px;
                            padding-inline.2rem;
                            background-color: grey;
                            font-size: 1rem;
                            height: 1.2rem;
                            width: 3rem;
                            padding-block: .2rem;
                            justify-content: start;
                            transition: .5s;

                            .thumb {
                                border-radius: 1rem;
                                width: 1rem;
                                height: 100%;
                                background-color: white;
                            }
                        }
                    }

                    td>input,
                    textarea {
                        width: 100%;
                        padding-inline: 0.5rem;
                        background: rgb(128, 128, 128, 0.2);
                        border: none;
                        color: black
                    }

                    td>input:focus {
                        outline: none;
                        border: 1px solid grey;
                    }

                    textarea:focus {
                        border: 1px solid grey;
                        outline: none;
                    }

                    tr>td>p {
                        width: max-content;
                    }

                    .buttons {
                        display: flex;
                        justify-content: end;
                        gap: 0.5rem;
                        margin-block-start: 1rem;

                        button,
                        label {
                            color: black;
                            background-color: rgb(185, 185, 185);
                            font-size: 0.95rem;
                            border: none;
                            padding-inline: 0.8rem;
                            padding-block: 0.2rem;
                            border-radius: 5px;
                        }
                    }
                }
            </style>
        @endif
        <div id="add-product-container" class="pcontainer">
            <div id="add-product">
                @if (!$creating)
                    <div class="add-btn" wire:click="$toggle('creating')"><i class="bi bi-plus-lg"></i></div>
                @else
                    <div class="image">
                        <div class="img-container">
                            <img src="{{ $image ? $image->temporaryUrl() : '' }}" alt="">
                        </div>
                    </div>
                    <div class="errors">
                        @error('name')
                            <div class="error">
                                {{ $message }}
                            </div>
                        @enderror
                        @error('stock')
                            <div class="error">
                                {{ $message }}
                            </div>
                        @enderror
                        @error('tags')
                            <div class="error">
                                {{ $message }}
                            </div>
                        @enderror
                        @error('category')
                            <div class="error">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <table class="product-details">
                        <tbody>
                            <tr>
                                <th style="width:6rem"></th>
                                <th></th>
                            </tr>
                            <tr>
                                <td class="paragraph">Provider</td>
                                <td><input type="text" wire:model='provider'></td>
                            </tr>
                            <tr>
                                <td class="paragraph">Name:</td>
                                <td><input type="text" wire:model.blur='name'></td>
                            </tr>
                            <tr>
                                <td class="paragraph">Category:</td>
                                <td><input type="text" wire:model='category'></td>
                            </tr>
                            <tr>
                                <td class="paragraph">Descrip:</td>
                                <td>
                                    <textarea wire:model='description'></textarea>
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
                                <style>

                                </style>
                                <td>
                                    <div class="toggle {{ $available ? 'thumb-active' : '' }}"
                                        wire:click="$toggle('available')">
                                        <div class="thumb"></div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="paragraph">Tags: </td>
                                <td>
                                    <input type="text" wire:model='tags'>
                                </td>
                            </tr>
                            <tr>
                                <td class="paragraph">Options: </td>
                                <td>
                                    <input type="text" wire:model='options'>
                                </td>
                            </tr>
                            <tr>
                                <td class="paragraph">Prices: </td>
                                <td>
                                    <input type="text" wire:model='prices'>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="buttons">
                        <button wire:click="$toggle('creating')"> Cancel</button>
                        <button wire:click='create'>Add</button>
                        <input wire:model='image' type="file" id="filebtn-hidden" hidden>
                        @if (strlen($name) > 5)
                            <label for="filebtn-hidden"> <i class="bi bi-camera"></i> Upload image</label>
                        @endif
                    </div>
                @endif
            </div>
        </div>
        @foreach ($products as $product)
            <livewire:dashboard.helpers.product-card :key="$product->id" :product="$product"
                @saved="update"></livewire:dashboard.helpers.product-card>
        @endforeach
    </div>
</main>
