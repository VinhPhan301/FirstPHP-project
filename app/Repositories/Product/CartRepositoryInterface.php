<?php
namespace App\Repositories\Product;

use App\Repositories\BaseRepositoryInterface;

interface CartRepositoryInterface extends BaseRepositoryInterface
{
    public function getCart();
}