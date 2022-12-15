<?php
namespace App\Repositories\Product;
use App\Models\ProductDetail;
use App\Models\Cart;
use App\Repositories\BaseRepository;
use App\Repositories\Product\CartItemRepositoryInterface;

class CartItemRepository extends BaseRepository implements CartItemRepositoryInterface
{
    //lấy model tương ứng
    public function getModel()
    {
        return \App\Models\CartItem::class;
    }


    public function updateOrCreate($itemData, $productDetailStorage)
    {
        $cartItem = $this->model
            ->where('productDetail_id', $itemData['productDetail_id']) //constant
            ->where('cart_id', $itemData['cart_id'])
            ->first();

        if(null === $cartItem) {
            $this->model->create($itemData);

            return 'true';
        } else {
            $newQuantity = $itemData['quantity'] + $cartItem->quantity;

            if ($newQuantity <= $productDetailStorage){
                $this->update($cartItem->id, ['quantity' => $newQuantity]);

                return 'true';
            } else {
                $leftQuantity = $productDetailStorage - $cartItem->quantity;
    
                return $leftQuantity;
            }  
        }
    }


    public function getCartById($id) 
    {
        $cart = Cart::where('user_id', $id)
            ->where('status', 'active')
            ->first();
        if(null == $cart) {

            return null;
        } else {
            $cartItems = $this->model
            ->where('cart_id',$cart->id)
            ->get();
     
            return $cartItems;
        }
        
    }
}