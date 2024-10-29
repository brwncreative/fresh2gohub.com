<?php

namespace App\Livewire\Dashboard;

use Livewire\WithFileUploads;
use Livewire\Attributes\On;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\MediaController;
use Livewire\Component;

class Products extends Component
{
    use WithFileUploads;
    public $products;
    public $category,
        $provider = 'Fresh2GoHub',
        $name,
        $description,
        $available = false,
        $stock,
        $creating = false,
        $image,
        $created, $chunk = 0;

    public $filtering = false, $search;
    public $categories = [
        'mixed packages',
        'vegetables',
        'prepackaged fruit and platters',
        'mash',
        'seasonings',
        'dry rubs (packs)',
        'meats',
        'seafood',
        'marinades'
    ];

    public $tags = [], $tagString;
    public $options = [], $optionString, $optionValueString;
    public $prices = [], $metricString, $priceValueString;
    /**
     * Prep products
     * @return void
     */
    #[On('reloadProducts')]
    public function prepProducts($chunk = 0)
    {
        $this->products = ProductController::paginate($this->filtering ? $this->search : '?', $chunk);
        $this->chunk = $this->products['position'];
        $this->dispatch('$refresh');
    }
    #[On('update')]
    public function create(
        $id = '?',
        $category = '?',
        $provider = '?',
        $name = '?',
        $description = '?',
        $available = '?',
        $stock = '?',
        $tags = '?',
        $options = '?',
        $prices = '?',
    ) {
        if ($id == '?') {
            $this->validate([
                'image' => 'required_with:name',
                'name' => 'required|min:3',
                'stock' => 'required',
                'tags' => 'required',
                'category' => 'required'
            ]);
        }
        $this->created = ProductController::create(
            $id == '?' ? null : $id,
            $category == '?' ? $this->category : $category,
            $provider == '?' ?  $this->provider : $provider,
            $name === '?' ? $this->name : $name,
            $description == '?' ? $this->description : $description,
            $available == '?' ? $this->available : $available,
            $stock == '?'  ? $this->stock : $stock,
            $tags == '?' ? $this->tags : $tags,
            $options == '?' ? $this->options :  $options,
            $prices == '?' ? $this->prices :  $prices,
        );
        if ($this->image) {
            MediaController::saveProductImageCloud($this->name, $this->created->id);
        }
        $this->dispatch('reloadProducts')->self();
    }
    #[On('remove')]
    public function remove($id)
    {
        ProductController::remove($id);
        $this->dispatch('reloadProducts')->self();
    }
    
    public function updated($property)
    {
        if ($property === 'image') {
            MediaController::saveFile($this->image->getContent(), $this->name);
        }
        if ($property == 'filtering') {
            switch ($this->filtering) {
                case true:
                    self::prepProducts();
                    break;
                case false:
                    self::prepProducts();
            }
        }
    }
    public function mount()
    {
        self::prepProducts();
    }
    public function render()
    {
        return view('livewire.dashboard.products');
    }
}
