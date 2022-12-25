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
        $orders = $this->model
        ->where('user_id', $userId)
        ->orderBy('created_at', 'DESC')
        ->get();

        return $orders;
    }

    public function getOrderByStatus($userId, $status)
    {
        $orders = $this->model
            ->where('user_id', $userId)
            ->where('status', $status)
            ->orderBy('created_at', 'DESC')
            ->get();
    
        return $orders;
    }

    public function getOrderStatus()
    {
        $arrStatus = [];
        $orders = $this->model->all();
        foreach ($orders as $order){
            $arrStatus[] = $order->status;
        }

        return array_unique($arrStatus);
    }

}