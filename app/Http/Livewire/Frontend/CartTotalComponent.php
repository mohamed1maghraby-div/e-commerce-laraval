<?php

namespace App\Http\Livewire\Frontend;

use Livewire\Component;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartTotalComponent extends Component
{
    public $cart_subtotal;
    public $cart_discount;
    public $cart_shipping;

    public $cart_total;
    public $cart_tax;

    protected $listeners = [
        'updateCart' => 'mount' //auto update
    ];

    public function mount()
    {
        $this->cart_subtotal = getNumbers()->get('subtotal');
        $this->cart_discount = getNumbers()->get('discount');
        $this->cart_tax = getNumbers()->get('productTaxes');
        $this->cart_shipping = getNumbers()->get('shipping');
        $this->cart_total = getNumbers()->get('total');
    }

    public function render()
    {
        return view('livewire.frontend.cart-total-component');
    }
}
