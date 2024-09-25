<?php

namespace App\Livewire\Dashboard\Helpers;

use App\Http\Controllers\MediaController;
use Livewire\WithFileUploads;
use Livewire\Component;

class ProductCard extends Component
{
    use WithFileUploads;

    public $product,
        $image,
        $editTags = false,
        $editOptions = false,
        $editPrices = false,
        $tags,
        $options,
        $prices,
        $category,
        $provider,
        $name,
        $description,
        $available,
        $stock;

    public function serializeAttributes($case)
    {
        $tags = function () {
            $string = (string)'';
            $count = 1;
            foreach ($this->product->tags as $tag) {
                $string .= $tag['tag'];
                if ($count != count($this->product->tags)) {
                    $string .= ' , ';
                }
                $count++;
            }
            return $string;
        };
        $options = function () {
            $string = (string)'';
            $count = 1;
            foreach ($this->product->options as $option) {
                $string .= $option['option'] . '/' . $option['value'];
                if ($count != count($this->product->options)) {
                    $string .= ' , ';
                }
                $count++;
            }
            return $string;
        };
        $prices = function () {
            $string = (string)'';
            $count = 1;
            foreach ($this->product->prices as $price) {
                $string .= $price['value'] . '/' . $price['metric'];
                if ($count != count($this->product->prices)) {
                    $string .= ' , ';
                }
                $count++;
            }
            return $string;
        };

        switch ($case) {
            case 'tags':
                $this->tags = $tags();
                break;
            case 'options':
                $this->options = $options();
                break;
            case 'prices':
                $this->prices = $prices();
                break;
        }
    }
    public function update()
    {
        $this->dispatch(
            'update',
            id: $this->product->id,
            category: $this->category,
            provider: $this->provider,
            name: $this->name,
            description: $this->description,
            available: $this->available,
            stock: $this->stock,
            tags: $this->tags,
            options: $this->options,
            prices: $this->prices
        );
    }
    public function remove()
    {
        $this->dispatch('remove', $this->product->id);
    }
    public function mount()
    {
        $this->name = $this->product->name;
        $this->provider = $this->product->provider;
        $this->category = $this->product->category;
        $this->description = $this->product->description;
        $this->stock = $this->product->stock;
        $this->available = $this->product->available;
        self::serializeAttributes('tags');
        self::serializeAttributes('options');
        self::serializeAttributes('prices');
    }
    public function updated($property)
    {
        if ($property === 'image') {
            MediaController::saveFile($this->image->getContent(), $this->name);
            MediaController::saveImageCloud($this->name);
        }
    }
    public function render()
    {
        return view('livewire.dashboard.helpers.product-card');
    }
}
