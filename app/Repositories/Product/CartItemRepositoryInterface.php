<?php
namespace App\Repositories\Product;

use App\Repositories\BaseRepositoryInterface;

interface CartItemRepositoryInterface extends BaseRepositoryInterface
{
    public function updateOrCreate($itemData, $productDetailStorage);
}