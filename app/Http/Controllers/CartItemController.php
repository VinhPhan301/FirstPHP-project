<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Product\CartItemRepositoryInterface;


class CartItemController extends Controller
{
    protected $cartItemRepo;

    public function __construct(CartItemRepositoryInterface $cartItemRepo)
    {
        $this->cartItemRepo = $cartItemRepo;
    }

    public function getViewCart()
    {   
        $cartItems = $this->cartItemRepo->getAll();

        if (!$cartItems || null === $cartItems) {
            return redirect()->back();
        }

        return view('shop.cart',[
            'cartItems' => $cartItems,
            'msg' => session()->get('msg') ?? null
        ]);
    }

    public function create(Request $request)
    {  
        $color = $request->color;
        $size = $request->size;
        $productID = $request->productID;
        $quantity = $request->quantity;
        $userID = $request->userID;

        $productDetailID = $this->cartItemRepo->getProductDetail($productID,$color, $size);

        $cartID = $this->cartItemRepo->getCart($userID);

        $data = [
            'cart_id' =>$cartID,
            'productDetail_id' => $productDetailID,
            'quantity' => $quantity,
        ];
        
        $cartItem = $this->cartItemRepo->create($data);

        return response()->json([
            'productDetailID' => $productDetailID,
            'userID' => $userID,
            'cartID' => $cartID,
            // 'quantity'=>$quantity,
        ],200);                            
     
    }
}
