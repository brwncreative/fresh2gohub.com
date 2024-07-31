<?php

namespace App\Livewire\Dashboard;

use Livewire\Attributes\Rule;
use Livewire\Component;
use App\Models\Product;
use App\Http\Controllers\FileController;
use Illuminate\Support\Facades\Request;
use App\Http\Controllers\ProductController;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class DashboardProducts extends Component
{
    use WithFileUploads;
    public $image;
    #[Rule('required|min:2')]
    public $products;
    #[Rule('required|min:2')]
    public $name;
    #[Rule('required|min:2')]
    public  $description;
    #[Rule('required|min:2')]
    public  $tags;
    public $tagGroup;
    public $in_stock = false;
    public $stock;
    #[Rule('required|min:2')]
    public $options;
    public $price;

    public function boot()
    {
        $this->products = self::list();
    }
    /**
     * Create a product with image
     * @return void
     */
    public function create()
    { 
        $resp = FileController::storeImageFile(str_replace(' ','_',$this->name), $this->image);
        ProductController::create(str_replace(' ','_',$this->name), $this->description, self::serializeTags(), $this->in_stock, $this->stock, $this->options, $this->price);
        redirect(route('dashboard-products'));
    }

    /**
     * Render Tags for User
     * @return bool|string[]
     */
    public function renderTags(){
       return $this->tagGroup = explode(',', $this->tags);
    }

    /**
     * List all products
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function list()
    {
        return Product::all();
    }
    public function serializeTags(){
        return preg_replace('/\s+/', '', $this->tags);
    }
    public function render()
    {
        self::renderTags();
        return view('livewire.dashboard.dashboard-products');
    }
}
