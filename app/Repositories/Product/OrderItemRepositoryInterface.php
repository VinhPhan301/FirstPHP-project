<?php
namespace App\Repositories\Product;

use App\Repositories\BaseRepositoryInterface;

interface OrderItemRepositoryInterface extends BaseRepositoryInterface
{
    public function getOrderItemByOrderId($orderId);
}