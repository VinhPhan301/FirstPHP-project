<?php

namespace App\Repositories\Product;

use App\Repositories\BaseRepositoryInterface;

interface OrderRepositoryInterface extends BaseRepositoryInterface
{
    public function getModel() ;
    public function getOrderByUserId($userId);

    public function getOrderByStatus($userId, $status);

    public function getOrderStatus();
    public function getOrderCancel($userId);
}
