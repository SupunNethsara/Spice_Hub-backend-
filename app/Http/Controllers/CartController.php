<?php

namespace App\Http\Controllers;

use App\Models\OrderProducts;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $cartItems = Cart::with('product')->where('user_id', $user->id)->get();

        return response()->json([
            'cartItems' => $cartItems->map(function ($item) {
                return [
                    'id' => $item->product_id,
                    'name' => $item->product->product_name,
                    'price' => $item->product->Product_price,
                    'image' => $this->getProductImage($item->product->Product_image),
                    'quantity' => $item->quantity,
                    'max_quantity' => $item->product->stock
                ];
            })
        ]);
    }

    public function addToCart(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:order_products,id',
            'quantity' => 'required|integer|min:1'
        ]);

        $user = Auth::user();
        $product = OrderProducts::findOrFail($request->product_id);

        $existingCartItem = Cart::where('user_id', $user->id)
            ->where('product_id', $request->product_id)
            ->first();

        if ($existingCartItem) {
            $newQuantity = $existingCartItem->quantity + $request->quantity;
            if ($newQuantity > $product->stock) {
                return response()->json([
                    'message' => 'Cannot add more than available stock',
                    'max_quantity' => $product->stock
                ], 422);
            }

            $existingCartItem->quantity = $newQuantity;
            $existingCartItem->save();
        } else {
            if ($request->quantity > $product->stock) {
                return response()->json([
                    'message' => 'Cannot add more than available stock',
                    'max_quantity' => $product->stock
                ], 422);
            }
            Cart::create([
                'user_id' => $user->id,
                'product_id' => $request->product_id,
                'quantity' => $request->quantity
            ]);
        }

        return response()->json(['message' => 'Product added to cart successfully']);
    }

    public function updateQuantity(Request $request, $productId)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        $user = Auth::user();
        $product = OrderProducts::findOrFail($productId);

        $cartItem = Cart::where('user_id', $user->id)
            ->where('product_id', $productId)
            ->firstOrFail();

        if ($request->quantity > $product->stock) {
            return response()->json([
                'message' => 'Cannot add more than available stock',
                'max_quantity' => $product->stock
            ], 422);
        }

        $cartItem->quantity = $request->quantity;
        $cartItem->save();

        return response()->json(['message' => 'Cart updated successfully']);
    }

    public function removeFromCart($productId)
    {
        $user = Auth::user();

        Cart::where('user_id', $user->id)
            ->where('product_id', $productId)
            ->delete();

        return response()->json(['message' => 'Product removed from cart']);
    }

    public function clearCart()
    {
        $user = Auth::user();

        Cart::where('user_id', $user->id)->delete();

        return response()->json(['message' => 'Cart cleared successfully']);
    }

    private function getProductImage($productImage)
    {
        try {
            $images = json_decode($productImage, true);
            return count($images) > 0 ? url('storage/' . $images[0]) : null;
        } catch (\Exception $e) {
            return null;
        }
    }
}
