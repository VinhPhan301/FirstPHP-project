<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductDetail;
use App\Models\Cart;
use App\Models\CartItem;
use App\Repositories\Product\CartItemRepositoryInterface;


class CartItemController extends Controller
{
    protected $cartItemRepo;

    public function __construct(CartItemRepositoryInterface $cartItemRepo)
    {
        $this->cartItemRepo = $cartItemRepo;
    }

    public function getViewCart(Request $request)
    {   
        $cartItems = $this->cartItemRepo->getAll();

        if (!$cartItems || null === $cartItems) {
            return redirect()->back();
        }

        return view('shop.cart',[
            'cartItems' => $cartItems,
            'msg' => session()->get('msg')
        ]);
    }

    public function create(Request $request)
    {  
        $color = $request->color;
        $size = $request->size;
        $productID = $request->productID;
        $quantity = $request->quantity;
        $userID = $request->userID;

        $productDetail = ProductDetail::where('product_id', $productID)
                                        ->where('color', $color)
                                        ->where('size', $size)
                                        ->get();
        $cart = Cart::where('user_id', $userID)
                        ->get();

        foreach ($productDetail as $item){
            $productDetailID = $item->id;
        }

        foreach ($cart as $item){
            $cartID = $item->id;
        }

        $cartItem = CartItem::create([
            'cart_id'=>$cartID,
            'productDetail_id'=>$productDetailID,
            'quantity'=>$quantity,
        ]);

        return response()->json([
            'productDetailID' => $productDetailID,
            'userID' => $userID,
            'cartID' => $cartID,
            // 'quantity'=>$quantity,
        ],200);                            
     
    }
}
