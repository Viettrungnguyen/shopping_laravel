<?php

namespace App\Repositories;

use App\Product;
use App\Repositories\BaseRepository;

class CartRepository extends BaseRepository
{
    public function getModel()
    {
        return Product::class;
    }

    public function addCart($slug)
    {
        $product = $this->model->where('slug', $slug)->first();

        $cart = session()->get('cart', []);
       
        if (isset($cart[$slug])) {
            $cart[$slug]['quantity']++;
        } else {
            $cart[$slug] = [
                "slug" => $product->slug,
                "name" => $product->name,
                "image" => $product->image_url,
                "price" => $product->price,
                "quantity" => 1,
            ];
        }

        session()->put('cart', $cart);

        return $cart;
    }

    public function addCartQuantity($slug, $req)
    {
        $product = $this->model->where('slug', $slug)->first();

        $cart = session()->get('cart', []);

        if (isset($cart[$slug])) {
            $cart[$slug]['quantity']++;
        } else {

            $cart[$slug] = [
                "slug" => $product->slug,
                "name" => $product->name,
                "image" => $product->image_url,
                "price" => $product->price,
                "quantity" => $req->quantity,
            ];
        }
        session()->put('cart', $cart);

        return $cart;
    }

    public function updateCart($req)
    {
        $cart = session()->get('cart');
        $cart[$req->slug]["quantity"] = $req->quantity;
        session()->put('cart', $cart);

        return $cart;
    }

    public function removeCart($req)
    {
        $cart = session()->get('cart');
        if (isset($cart[$req->slug])) {
            unset($cart[$req->slug]);
            session()->put('cart', $cart);
        }

        return $cart;
    }
}
