<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Cart;

class CartComponent extends Component
{
    // .............................\update cart/.............................
    public function increaseQuantity($rowId)
    {
        $product  = Cart::instance('cart')->get($rowId);
        $qty = $product->qty + 1;
        Cart::instance('cart')->update($rowId,$qty);
        $this->emitTo('cart-icon-component','refreshComponent');
    }

    public function decreaseQuantity($rowId)
    {
        $product  = Cart::instance('cart')->get($rowId);
        $qty = $product->qty - 1;
        Cart::instance('cart')->update($rowId,$qty);
        $this->emitTo('cart-icon-component','refreshComponent');
    }
    // .............................\delete cart/.............................
    public function destroy($id)
    {
        Cart::instance('cart')->remove($id);
        $this->emitTo('cart-icon-component','refreshComponent');
        session()->flash('success_message','Item has been removed!');
    }
        // .............................\delete all cart/.............................
    public function clearAll()
    {
        Cart::instance('cart')->destroy();
        $this->emitTo('cart-icon-component','refreshComponent');
    }

    public function render()
    {
        return view('livewire.cart-component');
    }
}
