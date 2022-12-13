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
        $productDetailPrice = $this->productDetailRepo->getProductDetailPrice($productID, $color, $size); // thua
        $productDetailStorage = $this->productDetailRepo->getStorage($productID, $color, $size);

        $user = Auth::guard('user')->user();

        if($userID === null) {
            return false;
        } else {
            $userID = $user->id;
            $cartFound = $this->cartRepo->getCart($userID);

            if(count($cartFound) == 0) {
                $data = [
                    'user_id' => $userID,
                    'status' => 'active', //constant
                ];
        
                $cart = $this->cartRepo->create($data);

                $itemData = [
                    'productDetail_id' => $productDetailID,
                    'quantity' => $quantity,
                    'cart_id' => $cart->id,
                    'total_price' => $quantity * $productDetailPrice,
                ];

                $cartItem = $this->cartItemRepo->updateOrCreate($itemData, $productDetailStorage);
            } else {
                $cartID = $cartFound->id;

                $itemData = [
                    'productDetail_id' => $productDetailID,
                    'quantity' => $quantity,
                    'cart_id' => $cartId,
                    'total_price' => $quantity * $productDetailPrice,
                ];
                $cartItem = $this->cartItemRepo->updateOrCreate($itemData, $productDetailStorage);

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
        $color = $request->color;
        $size = $request->size;
        $productID = $request->productID;

        $productDetailStorage = $this->productDetailRepo->getStorage($productID, $color, $size);
        
        if (null !== $productDetailStorage){
            return $productDetailStorage;
        }
        else {
            return 'false';
        }
    }
}
