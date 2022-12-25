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
    
    public function getProductDetailAll($productID, $color, $size)
    {
        $productDetail = $this->model->where('product_id', $productID)
            ->where('thumbnail', $color)
            ->where('size', $size)
            ->first();

        $productDetail;

        return $productDetail;
    }

    public function getSizeColor($productID)
    {
        $arrSize = [];
        $arrThumbnail = [];
        
        $productDetails = $this->model->where('product_id', $productID)->get();

        foreach ($productDetails as $productDetail){
            $arrSize[] = $productDetail->size;
            $arrThumbnail[] = $productDetail->thumbnail;
        }
        $sizeUnique = array_unique($arrSize);
        $thumbnailUnique = array_unique($arrThumbnail);

        return [
           'sizeUnique' => $sizeUnique, 
           'thumbnailUnique' => $thumbnailUnique
        ];
    }  
}