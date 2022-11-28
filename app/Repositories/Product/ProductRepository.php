<?php
namespace App\Repositories\Product;
use App\Models\Category;

use App\Repositories\BaseRepository;
use App\Repositories\Product\ProductRepositoryInterface;

class ProductRepository extends BaseRepository implements ProductRepositoryInterface
{
    //lấy model tương ứng
    public function getModel()
    {
        return \App\Models\Product::class;
    }

    /**
     * @param integer|null $id
     * 
     * @return void
     */

    public function getProduct()
    {
        return $this->model->select('name')->take(5)->get();
    }
}