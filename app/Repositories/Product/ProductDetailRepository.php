<?php
namespace App\Repositories\Product;
use App\Repositories\BaseRepository;
use App\Repositories\Product\ProductDetailRepositoryInterface;
use App\Models\ProductDetail;
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
        $productDetail = $this->model->where('product_id', $id)->get();

        return $productDetail;
    }
    
    public function getProductDetailID($productID, $color, $size)
    {
        $productDetail = $this->model->where('product_id', $productID)
            ->where('color', $color)
            ->where('size', $size)
            ->first();

        $productDetailID = $productDetail->id;

        return $productDetailID;
    }

    public function getSizeColor($productID)
    {
        $arrSize = [];
        $arrColor = [];
        
        $productDetails = $this->model->where('product_id', $productID)->get();

        foreach ($productDetails as $productDetail){
            $arrSize[] = $productDetail->size;
            $arrColor[] = $productDetail->color;
        }
        $sizeUnique = array_unique($arrSize);
        $colorUnique = array_unique($arrColor);

        return [
           'sizeUnique' => $sizeUnique, 
           'colorUnique' => $colorUnique
        ];
    }


    public function getProductDetailPrice($productID, $color, $size)
    {
        $productDetail = $this->model->where('product_id', $productID)
            ->where('color', $color)
            ->where('size', $size)
            ->first();
        
        $productDetailPrice = $productDetail->price;

        return $productDetailPrice;
    }

    public function getStorage($productID, $color, $size)
    {
        $productDetail = $this->model->where('product_id', $productID)
            ->where('color', $color)
            ->where('size', $size)
            ->first();

        $productDetailStorage = $productDetail->storage;

        return $productDetailStorage;
    }
}