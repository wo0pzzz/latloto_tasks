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
                'count' => 99
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

        return view('public/shop/index', $data);
    }

    public function addToCart($id) {
        $products = Session::get('product_ids');

        if (!$products) {
            $add = Session::put('product_ids', $id);
        } else {
            die();
            //$add = Session::push('product_ids', 3);
        }

        $products = Session::get('product_ids');
        var_dump($products);
        die();

        if ($add) {
            return response([
                'added' => true,
               // 'total' => $products
            ], 200);
        } else {
            return response([
                'added' => false
            ], 200);
        }
    }
}
