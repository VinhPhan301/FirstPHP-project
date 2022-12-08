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
        $cart = $this->model->where('user_id', $userID)->get();

        return $cart;
    }
}