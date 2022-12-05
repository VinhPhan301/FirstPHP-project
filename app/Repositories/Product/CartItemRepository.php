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

    public function getProductDetail($productID, $color, $size)
    {
        $productDetail = ProductDetail::where('product_id', $productID)
            ->where('color', $color)
            ->where('size', $size)
            ->first();

        $productDetailID = $productDetail->id;
        
        return $productDetailID;
    }

    public function getCart($userID)
    {
        $cart = Cart::where('user_id', $userID)->first();

        $cartID = $cart->id;
        
        return $cartID;
    }


}