<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Http\Resources\CartResource;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return CartResource::collection(Cart::where("user_id", auth()->user()->id)->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $fields = $request->validate([
            "product_id" => "numeric",
            "user_id" => "numeric",
            "quantity" => "numeric"
        ]);

        Cart::create($fields);

        return $this->index();
    }

    /**
     * Increment the quantity of a certain cart item.
     */
    public function incrementQuantity(Request $request, string $id)
    {
        $cart = Cart::find($id);
        $cart->update([
            "quantity" => ++$cart->quantity
        ]);

        return $this->index();
    }

    /**
     * Decrement the quantity of a certain cart item.
     */
    public function decrementQuantity(Request $request, string $id)
    {
        $cart = Cart::find($id);
        $cart->update([
            "quantity" => --$cart->quantity
        ]);

        return $this->index();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Cart::destroy($id);

        return $this->index();
    }
}
