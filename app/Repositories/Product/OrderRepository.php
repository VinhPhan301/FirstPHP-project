<?php

namespace App\Repositories\Product;

use App\Repositories\BaseRepository;
use App\Repositories\Product\OrderRepositoryInterface;
use App\Models\OrderItem;

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
        foreach ($orders as $order) {
            $arrStatus[] = $order->status;
        }

        return array_unique($arrStatus);
    }

    public function getOrderCancel($userId)
    {
        $orderCancels = $this->model
            ->where('user_id', $userId)
            ->where('status', 'cancel')
            ->get();

        return $orderCancels;
    }

    public function getBoughtTotalPrice($userId)
    {
        $orderCompletes = $this->model
            ->where('user_id', $userId)
            ->where('status', 'complete')
            ->get();

        $boughtTotal = 0;
        foreach ($orderCompletes as $orderComplete) {
            $orderItems = OrderItem::where('order_id', $orderComplete->id)->get();
            foreach ($orderItems as $orderItem) {
                $boughtTotal += $orderItem->total_price;
            }
        }

        return $boughtTotal;
    }
}
