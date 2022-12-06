<?php
namespace App\Repositories\Product;
use App\Models\Category;
use App\Repositories\BaseRepository;
use App\Repositories\Product\CategoryRepositoryInterface;

class CategoryRepository extends BaseRepository implements CategoryRepositoryInterface
{
    //lấy model tương ứng
    public function getModel()
    {
        return \App\Models\Category::class;
    }

}
