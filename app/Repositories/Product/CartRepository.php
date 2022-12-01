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

    public function getCart()
    {
        return $this->model->select('name')->take(5)->get();
    }
}