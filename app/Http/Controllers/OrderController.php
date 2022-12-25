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


    /**
     * Show Order list by UserId function
     *
     * @return void
     */
    public function getViewOrder(Request $request)
    {
        $user = Auth::guard('user')->user();
        
        if ($request->status === null || $request->status === 'all') {
            $orders = $this->orderRepo->getOrderByUserId($user->id);
        } else {
            $orders = $this->orderRepo->getOrderByStatus($user->id, $request->status);
        }
        $orderStatus = $this->orderRepo->getOrderStatus();

        return view('shop.userorder',[
            'orderStatus' => $orderStatus,
            'orders' => $orders,
            'msg' => session()->get(CommonConstant::MSG) ?? null
        ]);
    }

    

    /**
     * Create new order function
     *
     * @param Request $request
     * @return void
     */
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

    

    public function getViewAdminOrder() 
    {
        $orders = $this->orderRepo->getAll();

        return view('order.list',[
            'orders' => $orders,
            'msg' => session()->get(CommonConstant::MSG) ?? null
        ]);
    }


    public function getViewAdminOrderItem($id)
    {
        $order = $this->orderRepo->find($id);
        $orderItems = $this->orderItemRepo->getOrderItemByOrderId($id);

        return view('order.item',[
            'order' => $order,
            'orderItems' => $orderItems,
            'msg' => session()->get(CommonConstant::MSG) ?? null
        ]);
    }


    public function updateCancel(Request $request)
    {
        $orderCancel = $this->orderRepo->update($request->id, ['status' => 'cancelRequest']);
        
        return $orderCancel;
    }

    public function updateDelivering(Request $request)
    {

        if($request->status == 'active'){
            $orderDelivering = $this->orderRepo->update($request->id, ['status' => 'delivering']);
        } elseif($request->status == 'cancelRequest') {
            $orderDelivering = $this->orderRepo->update($request->id, ['status' => 'cancel']);
        } 

        return redirect()
            ->route('order.list')
            ->with(CommonConstant::MSG, 'Xác nhận đơn hàng thành công');
    }

}
