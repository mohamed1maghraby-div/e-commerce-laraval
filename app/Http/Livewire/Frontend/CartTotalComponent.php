<?php

namespace App\Http\Livewire\Frontend;

use Livewire\Component;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartTotalComponent extends Component
{
    public $cart_subtotal;

    public $cart_totla;
    public $cart_tax;

    protected $listeners = [
        'updateCart' => 'mount' //auto update
    ];

    public function mount()
    {
        $this->cart_subtotal = Cart::instance('default')->subtotal();
        $this->cart_tax = Cart::instance('default')->tax();
        $this->cart_totla = Cart::instance('default')->total();
    }

    public function render()
    {
        return view('livewire.frontend.cart-total-component');
    }
}
