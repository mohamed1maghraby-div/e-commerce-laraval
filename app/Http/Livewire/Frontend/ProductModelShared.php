<?php

namespace App\Http\Livewire\Frontend;

use App\Models\Product;
use Livewire\Component;
use Gloudemans\Shoppingcart\Facades\Cart;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class ProductModelShared extends Component
{
    use LivewireAlert;
    public $productModalCount = false;
    public $productModal = [];
    public $quantity = 1;

    protected $listeners = ['showProductModalAction'];

    public function decreaseQuantity()
    {
        if($this->quantity > 1){
            $this->quantity--;
        }
    }

    public function increaseQuantity()
    {
        if($this->productModal->quantity > $this->quantity){
            $this->quantity++;
        }else{
            $this->alert('warning', 'This is maximum quantity you can add!');
        }
    }

    public function addToCart()
    {
        $duplicates = Cart::instance('default')->search(function ($cartItem, $rowId){
            return $cartItem->id === $this->productModal->id;
        });
        if($duplicates->isNotEmpty()){
            $this->alert('error', 'Product already exists!');
        }else{
            Cart::instance('default')->add( $this->productModal->id, $this->productModal->name, $this->productModal->quantity, $this->productModal->price )->associate(Product::class);
            $this->quantity = 1;
            $this->alert('success', 'Product added in your cart successfully.');
        }
    }

    public function addToWishList()
    {
        $duplicates = Cart::instance('wishlist')->search(function ($cartItem, $rowId){
            return $cartItem->id === $this->productModal->id;
        });
        if($duplicates->isNotEmpty()){
            $this->alert('error', 'Product already exists!');
        }else{
            Cart::instance('wishlist')->add( $this->productModal->id, $this->productModal->name, 1, $this->productModal->price )->associate(Product::class);
            $this->alert('success', 'Product added in your wishlist cart successfully.');
        }
    }
    
    public function showProductModalAction($slug)
    {
        $this->productModalCount = true;
        $this->productModal = Product::withAvg('reviews', 'rating')->whereSlug($slug)->Active()->HasQuantity()->ActiveCategory()->firstOrFail();
        
    }
    public function render()
    {
        return view('livewire.frontend.product-model-shared');
    }
}
