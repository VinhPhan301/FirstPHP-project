<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Product\CartItemRepositoryInterface;
use App\Repositories\Product\ProductDetailRepositoryInterface;
use App\Repositories\Product\CartRepositoryInterface;
use App\Constants\CommonConstant;


class CartItemController extends Controller
{
    protected $cartItemRepo;
    protected $productDetailRepo;

    public function __construct(CartItemRepositoryInterface $cartItemRepo, ProductDetailRepositoryInterface $productDetailRepo,
    CartRepositoryInterface $cartRepo)
    {
        $this->cartItemRepo = $cartItemRepo;
        $this->cartRepo = $cartRepo;
        $this->productDetailRepo = $productDetailRepo;
    }

    public function getViewCart()
    {   
        $cartItems = $this->cartItemRepo->getAll();

        if (!$cartItems || null === $cartItems) {
            return redirect()->back();
        }

        return view('shop.cart',[
            'cartItems' => $cartItems,
            'msg' => session()->get(CommonConstant::MSG) ?? null
        ]);
    }

    public function create(Request $request)
    {  
        $color = $request->color;
        $size = $request->size;
        $productID = $request->productID;
        $quantity = $request->quantity;
        $userID = $request->userID;

        $productDetailID = $this->productDetailRepo->getProductDetailID($productID,$color, $size);

        $cartID = $this->cartRepo->getCart($userID);

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
