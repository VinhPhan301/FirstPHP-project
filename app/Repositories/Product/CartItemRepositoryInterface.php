<?php
namespace App\Repositories\Product;

use App\Repositories\BaseRepositoryInterface;

interface CartItemRepositoryInterface extends BaseRepositoryInterface
{
    public function getProductDetail($productID, $color, $size);

    public function getCart($userID);
}