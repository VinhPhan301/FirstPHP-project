<?php

namespace App\Repositories\Product;

use App\Repositories\BaseRepository;
use App\Repositories\Product\ProductDetailRepositoryInterface;
use App\Models\OrderItem;

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

        foreach ($productDetails as $productDetail) {
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

    public function updateProductDetailStorage($orderId)
    {
        $orderItems = OrderItem::where('order_id', $orderId)->get();

        foreach ($orderItems as $orderItem) {
            $productDetail = $this->model->find($orderItem->productDetail_id);
            $newStorage = $productDetail->storage - $orderItem->quantity;
            if ($newStorage < 0) {
                return false;
            }
            $productDetailUpdate = $this->update($orderItem->productDetail_id, [
                'sold_out'=>$orderItem->quantity + $productDetail->sold_out,
                'storage' => $newStorage,
            ]);
        }

        return $productDetailUpdate->product_id;
    }

    public function updateOrCreate($attributes = [])
    {
        $existProductDetail = $this->model
            ->where('color', $attributes['color'])
            ->where('size', $attributes['size'])
            ->where('thumbnail', $attributes['thumbnail'])
            ->first();

        if ($existProductDetail) {
            $updateProductDetail = $this->update($existProductDetail->id, [
                'price' => $attributes['price'],
                'storage' => $existProductDetail->storage + $attributes['storage']
            ]);

            return $updateProductDetail;
        }
        $createProductDetail = $this->create($attributes);

        return $createProductDetail;
    }

    public function getProductPagination($id)
    {
        $products = $this->model->where('product_id', $id)->orderBy('created_at', 'DESC')->paginate(5, ['*'], 'np');

        return $products;
    }
}
