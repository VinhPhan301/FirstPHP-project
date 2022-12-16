<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Product\CartItemRepositoryInterface;
use App\Repositories\Product\ProductDetailRepositoryInterface;
use App\Repositories\Product\CartRepositoryInterface;
use App\Constants\CommonConstant;
use Auth;


class CartItemController extends Controller
{
    protected $cartItemRepo;
    protected $productDetailRepo;
    protected $cartRepo;

    public function __construct(CartItemRepositoryInterface $cartItemRepo,
    ProductDetailRepositoryInterface $productDetailRepo,
    CartRepositoryInterface $cartRepo)
    {
        $this->cartItemRepo = $cartItemRepo;
        $this->cartRepo = $cartRepo;
        $this->productDetailRepo = $productDetailRepo;
    }

    /**
     * ViewAllCart function
     *
     * @return void
     */
    public function getViewCart() 
    {   
        $user = Auth::guard('user')->user();
        if(null == $user){
            return redirect()
                ->route('shop.login');
        } else {
            $cartItems = $this->cartItemRepo->getCartById($user->id);

            if (!$cartItems || null === $cartItems) {
                return redirect()
                    ->back()
                    ->with(CommonConstant::MSG, 'Không có sản phẩm trong giỏ');
            }

            return view('shop.cart',[
                'cartItems' => $cartItems,
                'msg' => session()->get(CommonConstant::MSG) ?? null
            ]);
        }  
    }


    /**
     * Delete CartItem by ID function
     *
     * @param Request $request
     * @return void
     */
    public function delete(Request $request)
    {  
        $id = $request->id;
        $cartItem = $this->cartItemRepo->delete($id);

        if(true === $cartItem){
            return 'true';
        }
        else {
            return 'false';
        }
    }


    /**
     * Update CartItem By ID function
     *
     * @param Request $request
     * @return void
     */
    public function update(Request $request)
    { 
        $quantity = $request->quantity;
        $cartItemID = $request->id;
        $productDetailPrice = $request->productDetailPrice;

        $data = [
            'quantity' => $quantity,
            'total_price' => $quantity * $productDetailPrice
        ];
        $cartItemUpdate = $this->cartItemRepo->update($cartItemID, $data);

        if($cartItemUpdate){
            return 'true';
        } else {
            return 'false';
        }
    }
}
