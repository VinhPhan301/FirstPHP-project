<?php
namespace App\Repositories\Product;

use App\Repositories\BaseRepositoryInterface;

interface ProductDetailRepositoryInterface extends BaseRepositoryInterface
{
    public function getProductDetail($id);

    public function getProductDetailID($productID, $color, $size);

    public function getSizeColor($productID);
}