<?php
namespace App\Repositories\Product;
use App\Repositories\BaseRepository;
use App\Repositories\Product\ProductDetailRepositoryInterface;
use App\Models\ProductDetail;
use App\Models\Product;
class ProductDetailRepository extends BaseRepository implements ProductDetailRepositoryInterface
{
    //lấy model tương ứng
    public function getModel()
    {
        return \App\Models\ProductDetail::class;
    }

    /**
     * @param integer|null $id
     * 
     * @return void
     */

    public function getProductDetail($id)
    {
        $productDetail = ProductDetail::where('product_id', $id)->get();

        return $productDetail;
    }

    public function getProduct($id)
    {
        $product = Product::find($id);

        return $product;
    }

}