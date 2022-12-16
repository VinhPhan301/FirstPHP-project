<?php
namespace App\Repositories\Product;

use App\Repositories\BaseRepositoryInterface;

interface OrderRepositoryInterface extends BaseRepositoryInterface
{
    public function getOrderByUserId($userId);
}