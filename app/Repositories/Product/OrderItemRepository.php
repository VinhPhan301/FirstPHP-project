<?php
namespace App\Repositories\Product;
use App\Repositories\BaseRepository;
use App\Repositories\Product\OrderItemRepositoryInterface;

class OrderItemRepository extends BaseRepository implements OrderItemRepositoryInterface
{
    //lấy model tương ứng
    public function getModel()
    {
        return \App\Models\OrderItem::class;
    }

    public function getOrderItemByOrderId($orderId)
    {
        $orderItems = $this->model
            ->where('order_id', $orderId)
            ->get();

        return $orderItems;
    }
}