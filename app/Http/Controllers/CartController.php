<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Constants\CommonConstant;
use App\Repositories\Product\CartRepositoryInterface;
use App\Repositories\Product\CartItemRepositoryInterface;
use App\Repositories\Product\ProductDetailRepositoryInterface;

class CartController extends Controller
{   
    protected $cartRepo;
    protected $cartItemRepo;
    protected $productDetailRepo;

    public function __construct(CartRepositoryInterface $cartRepo,
     CartItemRepositoryInterface $cartItemRepo,
     ProductDetailRepositoryInterface $productDetailRepo
     )
    {
        $this->cartRepo = $cartRepo;
        $this->cartItemRepo = $cartItemRepo;
        $this->productDetailRepo = $productDetailRepo;
    }

    /**
     * Shop Cart function
     *
     * @return View
     */
    public function getViewCart() : View
    {  
        return view('shop.cart');
    }


    /**
     * Create Cart and CartItem function
     *
     * @param Request $request
     * @return void
     */
    public function createCart(Request $request)
    {
        $productID = $request->productID;
        $color = $request->color;
        $size = $request->size;
        $quantity = (int)$request->quantity;

        $productDetailID = $this->productDetailRepo->getProductDetailID($productID, $color, $size);
        
        if(Auth::guard('user')->check() == false){
            return 'false';
        }
        else{
            $userID = Auth::guard('user')->user()->id;
            $cartFound = $this->cartRepo->getCart($userID);

            if(count($cartFound) == 0){

                $data = [
                    'user_id' => $userID,
                    'status' => 'active',
                ];
        
                $cart = $this->cartRepo->create($data);

                $itemData = [
                    'productDetail_id' => $productDetailID,
                    'quantity' => $quantity,
                    'cart_id' => $cart->id,
                ];
                $cartItem = $this->cartItemRepo->create($itemData);
            }
            else {
                foreach ($cartFound as $cart){
                    $cartId = $cart->id;
                }

                $itemData = [
                    'productDetail_id' => $productDetailID,
                    'quantity' => $quantity,
                    'cart_id' => $cartId,
                ];
                $cartItem = $this->cartItemRepo->create($itemData);
            }
        }      
    }
}
