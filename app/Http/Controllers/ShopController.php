<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;


class ShopController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->products = [
            0 => [
                'id'    => 1,
                'title' => 'Product 1',
                'price' => 10.00,
                'count' => 1
            ],
            1 => [
                'id'    => 2,
                'title' => 'Product 2',
                'price' => 12.31,
                'count' => 50
            ],
            2 => [
                'id'    => 3,
                'title' => 'Product 3',
                'price' => 16.99,
                'count' => 10
            ],
            3 => [
                'id'    => 4,
                'title' => 'Product 4',
                'price' => 36.98,
                'count' => 5
            ],
        ];
    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data = [];

        $data['products'] = $this->products;
        if (session()->get('product_ids')) {
            if (is_array(session()->get('product_ids'))) {
                $data['cart_count'] = count(session()->get('product_ids'));
            } else if (session()->get('product_ids')){
                $data['cart_count'] = 1;
            }
        }

        return view('public/shop/index', $data);
    }

    public function addToCart($id) {

        $products = session()->get('product_ids');
        if (!$products) {
            session()->put('product_ids', $id);
        } else {
            $new_ids = [];
            if (is_array($products)) {
                foreach ($products as $product) {
                    $new_ids[] = $product;
                }
                $new_ids[] = $id;
            } else {
                $new_ids[] = $products;
                $new_ids[] = $id;
            }

            session()->put('product_ids', $new_ids);
        }

        $products = session()->get('product_ids');

        return response([
            'products'  => $products
        ], 200);

    }

    public function removeFromCart($id) {

        $products = session()->get('product_ids');
        if ($products) {
            $new_ids = [];
            if (is_array($products)) {
                foreach ($products as $product) {
                    if ($product != $id) {
                        $new_ids[] = $product;
                    }
                }
                session()->put('product_ids', $new_ids);
            } else {
                session()->forget('product_ids');
            }
        }

        if (session()->get('product_ids')) {
            $products = count(session()->get('product_ids'));
        } else {
            $products = 0;
        }

        return response([
            'products'  => $products
        ], 200);

    }

    public function checkout() {
        $data = [];
        $total_price = 0.00;

        $product_ids = session()->get('product_ids');
        if ($product_ids) {
            if (is_array($product_ids)) {
                foreach ($product_ids as $one) {
                    if (!isset($data['products'][$one])) {
                        $data['products'][$one] = $this->products[$one-1];
                        $data['products'][$one]['count'] = 1;
                    } else {
                        $data['products'][$one]['count'] += 1;
                    }

                    $total_price += $data['products'][$one]['price'];
                }
            } else {
                $data['products'][0] = $this->products[$product_ids-1];
                $total_price = $data['products'][0]['price'];
            }
        }

        $data['total_price'] = $total_price;

        return view('public/shop/checkout', $data);
    }

    public function goCheckout(Request $request) {

        $product_ids = session()->get('product_ids');
        $transaction = $request->input();
        $cart = [];

        if (is_array($product_ids)) {
            foreach ($product_ids as $one) {
                if (!isset($data['products'][$one])) {
                    $cart[$one] = $this->products[$one-1];
                    $cart[$one]['count'] = 1;
                } else {
                    $cart[$one]['count'] += 1;
                }
            }
        } else {
            $cart = $this->products[$product_ids-1];
        }

        var_dump($cart);
        var_dump($transaction);
        session()->forget('product_ids');
    }
}
