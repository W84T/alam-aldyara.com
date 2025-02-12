<?php

namespace App\Helpers;


use App\Models\Product;
use Illuminate\Support\Facades\Cookie;

class CartManagement
{
    static public function addItemToCard($product_id)
    {
        $cart_items = self::getCartItemsFromCookie();
        $existing_item = Null;

        foreach ($cart_items as $key => $item) {
            if ($item['product_id'] == $product_id) {
                $existing_item = $key;
                break;

            }
        }
        if ($existing_item !== null) {
            $cart_items[$existing_item]['quantity']++;
            $cart_items[$existing_item]['total_amount'] = $cart_items[$existing_item]['quantity'] * $cart_items[$existing_item]['unit_amount'];
        }else{
            $product = Product::where('id', $product_id)->first(['id', 'name', 'price', 'images']);
            if($product){
                $cart_items[] = [
                    'product_id' => $product->id,
                    'name' => $product->name,
                    'unit_amount' => $product->price,
                    'total_amount' => $product->price,
                    'quantity' => 1,
                    'image' => $product->images[0],
                ];
            }
        }

        self::addCartItemToCookie($cart_items);
        return count($cart_items);
    }

    static public function removeCartItem($product_id){
        $cart_items = self::getCartItemsFromCookie();

        foreach ($cart_items as $key => $item) {
            if ($item['product_id'] == $product_id) {
                unset($cart_items[$key]);
            }
        }

        self::addCartItemToCookie($cart_items);

        return $cart_items;
    }

    static public function getCartItemsFromCookie()
    {
        $cart_item = json_decode(Cookie::get('cart_items'), true);
        if (!$cart_item) {
            $cart_item = [];
        }
        return $cart_item;
    }

    static public function addCartItemToCookie($cartItem)
    {
        Cookie::queue('cart_items', json_encode($cartItem), 60 * 24 * 30);
    }

    static public function clearCartItems()
    {
        Cookie::queue(Cookie::forget('cart_items'));
    }

    static public function incrementQuantityToCartItem($product_id){
        $cart_items = self::getCartItemsFromCookie();

        foreach ($cart_items as $key => $item) {
            if ($item['product_id'] == $product_id) {
                $cart_items[$key]['quantity']++;
                $cart_items[$key]['total_amount'] = $cart_items[$key]['quantity'] * $cart_items[$key]['unit_amount'];
            }
        }

        self::addCartItemToCookie($cart_items);
        return $cart_items;
    }

    static public function decrementQuantityToCartItem($product_id){
        $cart_items = self::getCartItemsFromCookie();
        foreach ($cart_items as $key => $item) {
            if ($item['product_id'] == $product_id) {
                if($cart_items[$key]['quantity'] > 1){
                    $cart_items[$key]['quantity']--;
                    $cart_items[$key]['total_amount'] = $cart_items[$key]['quantity'] * $cart_items[$key]['unit_amount'];
                }
            }
        }

        self::addCartItemToCookie($cart_items);
        return $cart_items;
    }
    static public function calculateGrandTotal($items){
        return array_sum(array_column($items, 'total_amount'));
    }
}
