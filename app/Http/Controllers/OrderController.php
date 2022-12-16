<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Product\OrderRepositoryInterface;
use App\Repositories\Product\OrderItemRepositoryInterface;
use App\Repositories\Product\CartItemRepositoryInterface;
use App\Repositories\Product\CartRepositoryInterface;
use App\Constants\CommonConstant;
use Auth;

class OrderController extends Controller
{
    protected $orderRepo;
    protected $orderItemRepo;
    protected $cartItemRepo;
    protected $cartRepo;

    public function __construct(OrderRepositoryInterface $orderRepo,
    CartItemRepositoryInterface $cartItemRepo,
    OrderItemRepositoryInterface $orderItemRepo,
    CartRepositoryInterface $cartRepo,)
    {
        $this->orderRepo = $orderRepo;
        $this->cartItemRepo = $cartItemRepo;
        $this->cartRepo = $cartRepo;
        $this->orderItemRepo = $orderItemRepo;

    }


    public function createOrder(Request $request)
    {
        $user = Auth::guard('user')->user();
        if (!$user || null === $user) {

            return $user;
        } else {
            $data =[
                'user_id' => $user->id,
                'address' => $request->address,
                'phone' => $request->phone,
                'payment_method' => $request->payment_method,
                'total' => $request->total,
                'note' => $request->note,
                'status' => 'active',
            ];

            $order = $this->orderRepo->create($data);
            
            $cartItems = $this->cartItemRepo->getCartById($user->id);

            foreach ($cartItems as $cartItem) {
                $cart = $this->cartRepo->find($cartItem->cart_id);
                if(null !== $cart) {
                    $cart = $this->cartRepo->update($cartItem->cart_id,['status'=>'checkout']);
                }
                $orderItemData = [
                    'order_id' => $order->id,
                    'productDetail_id' => $cartItem->productDetail_id,
                    'quantity' => $cartItem->quantity,
                    'price' => $cartItem->price,
                    'total_price' => $cartItem->total_price,
                ];
                $cartItemDelete = $this->cartItemRepo->delete($cartItem->id);
                $orderItem = $this->orderItemRepo->create($orderItemData);  
            }

            return redirect()
                ->route('shop.view')
                ->with(CommonConstant::MSG, 'Đặt hàng thành công');
        }
    }
}
