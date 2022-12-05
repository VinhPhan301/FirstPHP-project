<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductDetail;
use App\Models\Cart;


class CartController extends Controller
{   
    
    public function getViewCart(Request $request)
    {   

        return view('shop.cart');
    }

    public function create(Request $request)
    {
        // $color = $request->query('color');
        // $size = $request->query('size');
        // $productID = $request->query('productID');
        // $quantity = $request->query('quantity');

        // $productDetailID = ProductDetail::where('product_id', $productID)
        //                                 ->where('color', $color)
        //                                 ->where('size', $size)
        //                                 ->get();
        // dd($productDetailID);                               

            
    }
}
