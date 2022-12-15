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
        $quantity = (int)$request->quantity;

        $productDetail = $this->productDetailRepo->getProductDetailAll($request->productID, $request->color, $request->size);

        $user = Auth::guard('user')->user();
        if($user === null) {

            return 'false';
        } else {
            $userId = $user->id;
            $cartFound = $this->cartRepo->getCart($userId);
            
            if( null == $cartFound ) {
                $data = [
                    'user_id' => $userId,
                    'status' => 'active', //constant
                ];
        
                $cart = $this->cartRepo->create($data);

                $itemData = [
                    'productDetail_id' => $productDetail->id,
                    'quantity' => $quantity,
                    'cart_id' => $cart->id,
                    'total_price' => $quantity * $productDetail->price,
                ];

                $cartItem = $this->cartItemRepo->updateOrCreate($itemData, $productDetail->storage);

                return 'newcart';
            } else {
                $cartId = $cartFound->id;

                $itemData = [
                    'productDetail_id' => $productDetail->id,
                    'quantity' => $quantity,
                    'cart_id' => $cartId,
                    'total_price' => $quantity * $productDetail->price,
                ];
                $cartItem = $this->cartItemRepo->updateOrCreate($itemData, $productDetail->storage);

                return $cartItem;
            }
        }      
    }


    /**
     * Get storage number Limited function
     *
     * @param Request $request
     * @return void
     */
    public function getStorage(Request $request) 
    {
        $productDetail = $this->productDetailRepo->getProductDetailAll($request->productID, $request->color, $request->size);
        
        if (null !== $productDetail->storage){
            return $productDetail->storage;
        }
        else {
            return false;
        }
    }
}
