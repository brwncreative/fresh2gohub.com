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
        $editOptions = false,
        $editPrices = false,
        $category,
        $provider,
        $name,
        $description,
        $available,
        $stock,
        $categories;

    public $tagString, $tags = [];
    public $optionString, $optionValueString, $options = [];
    public $metricString, $priceValueString, $prices = [];

    public function serializeAttributes($case)
    {
        // Serialiaze Tags
        $tags = function () {
            $array = [];
            foreach ($this->product->tags as $tag) {
                array_push($array, $tag['tag']);
            }
            return $array;
        };
        // Serialize Options
        $options = function () {
            $array = [];
            foreach ($this->product->options as $option) {
                array_push($array, ['option' => $option['option'], 'value' => $option['value']]);
            }
            return $array;
        };
        // Serialize Prices
        $prices = function () {
            $array = [];
            foreach ($this->product->prices as $price) {
                array_push($array, ['value' => $price['value'], 'metric' => $price['metric']]);
            }
            return $array;
        };

        // Cases
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
            available: $this->available ? 1 : 0,
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
    public function removeImage()
    {
        MediaController::deleteProductImageCloud($this->product->id);
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
            MediaController::saveProductImageCloud($this->name, $this->product->id);
        }
    } 
    // Handle Tags
    public function handleTag($handle, $key = '?')
    {
        switch ($handle) {
            case 'add':
                array_push($this->tags, $this->tagString);
                $this->tagString = null;
                break;
            case 'del':
                unset($this->tags[$key]);
        }
    }
    // Handle Options
    public function handleOption($handle, $key = '?')
    {
        switch ($handle) {
            case 'add':
                array_push($this->options, ['option' => $this->optionString, 'value' => $this->optionValueString]);
                $this->optionString = null;
                $this->optionValueString = null;
                break;
            case 'del':
                unset($this->options[$key]);
        }
    }
    // Handle Price
    public function handlePrice($handle, $key = '?')
    {

        switch ($handle) {
            case 'add':
                array_push($this->prices, ['value' => $this->priceValueString, 'metric' => $this->metricString]);
                $this->priceValueString = null;
                $this->metricString = null;
                break;
            case 'del':
                unset($this->prices[$key]);
        }
    }
    public function render()
    {
        return view('livewire.dashboard.helpers.product-card');
    }
}
