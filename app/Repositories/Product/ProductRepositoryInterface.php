<?php

namespace App\Repositories\Product;

use App\Repositories\BaseRepositoryInterface;

interface ProductRepositoryInterface extends BaseRepositoryInterface
{
    public function getProductList();
    public function getProductName($type);
    public function getProductType($type);
    public function getViewCategory($type, $categoryName);
    public function findProduct($categoryName, $type, $productName);
    public function getRelatedProduct($productID, $product);
    public function updateProductSoldout($id);
    public function createOrUpdate($attribute = []);
    public function searchProduct($search);
}
