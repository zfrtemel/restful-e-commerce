<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends BaseController
{

    public function AddToCart(Request $request)
    {
        $cart = Cart::where('cart_user_id', Auth::user()->id)->where('cart_product_id', $request->product_id)->first();
        if ($cart) {
            $cart->cart_product_quantity = $cart->cart_product_quantity + $request->quantity;
            $cart->cart_product_subtotal = $cart->cart_product_quantity * $cart->cart_product_price;
            $cart->save();
            return $this->sendResponse($cart, 'Ürün Sepete Eklendi.');
        } else {
            $cart = new Cart();
            $cart->cart_user_id = Auth::user()->id;
            $product = Product::where('id', $request->product_id)->first();
            $cart->cart_product_id = $request->product_id;
            $cart->cart_product_name = $product->product_name;
            $cart->cart_product_price = $product->product_price;
            $cart->cart_product_quantity = $request->quantity;
            $cart->cart_product_subtotal = $product->product_price * $request->quantity;
            $cart->save();
            return $this->sendResponse($cart, 'Ürün Sepete Eklendi.');
        }
    }
    public function ListCart(Request $request)
    {
        $cart = Cart::where('cart_user_id', Auth::user()->id)->get();
        return $this->sendResponse($cart, 'Sepet Listesi Başarıyla Getirildi.');
    }
    public function DeleteCart(Request $request)
    {
        if (@$request->type == "All") {
            $cart = Cart::where('cart_user_id', Auth::user()->id)->get();
            foreach ($cart as $key => $value) {
                $value->delete();
            }
            return $this->sendResponse($cart, 'Sepet Boşaltıldı.');
        } else {
            $cart = Cart::where('cart_user_id', Auth::user()->id)->where('cart_product_id', $request->product_id)->first();
            $cart->delete();
            return $this->sendResponse($cart, 'Ürün Sepetten Silindi.');
        }
    }
    public function UpdateCart(Request $request)
    {
        $cart = Cart::where('cart_user_id', Auth::user()->id)->where('cart_product_id', $request->product_id)->first();
        $cart->cart_product_quantity = $request->quantity;
        $cart->cart_product_subtotal = $request->quantity * $cart->cart_product_price;
        $cart->save();
        return $this->sendResponse($cart, 'Ürün Sepet Güncellendi.');
    }
}
