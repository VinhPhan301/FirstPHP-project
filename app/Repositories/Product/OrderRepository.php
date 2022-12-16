<?php
namespace App\Repositories\Product;
use App\Repositories\BaseRepository;
use App\Repositories\Product\OrderRepositoryInterface;

class OrderRepository extends BaseRepository implements OrderRepositoryInterface
{
    //lấy model tương ứng
    public function getModel()
    {
        return \App\Models\Order::class;
    }

    public function getOrderByUserId($userId)
    {
        $orders = $this->model->where('user_id', $userId)->get();

        return $orders;
    }

}