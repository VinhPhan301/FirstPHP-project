<?php
namespace App\Repositories\Product;

use App\Repositories\BaseRepository;
use App\Repositories\Product\CartRepositoryInterface;

class CartRepository extends BaseRepository implements CartRepositoryInterface
{
    //lấy model tương ứng
    public function getModel()
    {
        return \App\Models\Cart::class;
    }

    public function getCart($userID)
    {
        $cart = Cart::where('user_id', $userID)->first();

        $cartID = $cart->id;
        
        return $cartID;
    }
}