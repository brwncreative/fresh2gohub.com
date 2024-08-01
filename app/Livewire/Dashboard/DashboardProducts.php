<?php

namespace App\Livewire\Dashboard;

use Livewire\Attributes\Rule;
use Livewire\Attributes\Validate;
use Livewire\Component;
use App\Models\Product;
use App\Http\Controllers\FileController;
use Illuminate\Support\Facades\Request;
use App\Http\Controllers\ProductController;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class DashboardProducts extends Component
{
    use WithFileUploads;
    #[Validate('image|max:52288')]
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
    #[Rule('required|min:2')]
    public $metric;
    public $price;

    public function boot()
    {
        $this->products = self::list();
    }
    public function generateUrl()
    {
        return FileController::serveImageFile(self::serializeName(), 'webp');
    }
    public function serializeTags()
    {
        return preg_replace('/\s+/', '', $this->tags);
    }
    public function serializeName()
    {
        $name = strtolower($this->name);
        $name = str_replace(' ', '_', $this->name);
        return $name;
    }
    /**
     * Render Tags for User
     * @return bool|string[]
     */
    public function renderTags()
    {
        $itr = 0;

        $this->tagGroup = explode(',', $this->tags);
        foreach ($this->tagGroup as $tag) {
            $altr = preg_replace('/\s+/', '', $tag);
            $altr = str_replace(' ', '', $altr);
            $this->tagGroup[$itr] = $altr;
            $itr++;
        }
        return $this->tagGroup;
    }


    /**
     * Create a product with image
     * @return void
     */
    public function create()
    { //  $this->validate();
        $resp = FileController::storeImageFile(str_replace(' ', '_', $this->name), $this->image);
        ProductController::create(self::serializeName(), $this->description, self::serializeTags(), $this->in_stock, $this->stock, $this->options, $this->price, $this->metric, self::generateUrl());
        redirect(route('dashboard-products'));
    }

    /**
     * List all products
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function list()
    {
        return Product::all();
    }
    public function render()
    {
        self::renderTags();
        return view('livewire.dashboard.dashboard-products');
    }
}
