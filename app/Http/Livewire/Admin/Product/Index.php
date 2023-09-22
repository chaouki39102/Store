<?php

namespace App\Http\Livewire\Admin\Product;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $product_id;
    public $product_code,
    $name,
    $description,
    $quantity,
    $purchase_price,
    $sale_price,
    $image_url,
    $category_id,
    $status;

    public function render()
    {
        $products = Product::with('category')->get();
        return view('livewire.admin.product.index',compact('products'));
    }
    function showProduct($product_id) {
        $product = Product::find($product_id);

        $this->product_id= $product->product_id;
        $this->product_code= $product->product_code;
        $this->name= $product->name;
        $this->description= $product->description;
        $this->quantity= $product->quantity;
        $this->purchase_price= $product->purchase_price;
        $this->sale_price= $product->sale_price;
        $this->image_url= $product->image_url;
        $this->category_id= $product->category_id;
        $this->status= $product->status;
        $this->dispatchBrowserEvent('show-show-product-modal');

    }
    function deleteProduct($product_id) {
        $this->product_id= $product_id;

    }
    public function destroyProduct()
    {
        $product = Product::find($this->product_id);
        $product->delete();
        Session()->flash('message', 'Product deleted!');
        $this->dispatchBrowserEvent('close-modal');
    }
}
