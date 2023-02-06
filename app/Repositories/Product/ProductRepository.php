<?php

namespace App\Repositories\Product;

use App\Models\Product;
use App\Models\ProductDetail;
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

    public function getProductList()
    {
        $arrProductName = [];
        $products = Product::all();
        foreach ($products as $product) {
            $arrProductName[] = $product->name;
        }
        $productList = array_unique($arrProductName);
        return $productList;
    }

    public function getProductName($type)
    {
        $arrProductName = [];
        $products = Product::where('type', $type)->get();

        foreach ($products as $product) {
            $productNameSplit = explode(' ', $product->name);
            $productNameJoin = $productNameSplit[0]." ".$productNameSplit[1];
            $arrProductName[] = $productNameJoin;
        }
        $productList = array_unique($arrProductName);

        return $productList;
    }

    public function getProductType($type)
    {
        $products = Product::where('type', $type)->orderBy('created_at', 'DESC')->get();

        return $products;
    }

    public function getViewCategory($type, $categoryName)
    {
        $arrProductName = [];
        $category = Category::where('name', $categoryName)->first();
        if (null !== $category && null !== $type) {
            $products = $this->model
                ->where('type', $type)
                ->where('category_id', $category->id)
                ->orderBy('created_at', 'DESC')
                ->get();
        }
        if (null !== $category && null === $type) {
            $products = $this->model
                ->where('category_id', $category->id)
                ->orderBy('created_at', 'DESC')
                ->get();
        }

        foreach ($products as $product) {
            $productNameSplit = explode(' ', $product->name);
            $productNameJoin = $productNameSplit[0]." ".$productNameSplit[1];
            $arrProductName[] = $productNameJoin;
        }
        $productList = array_unique($arrProductName);

        return [
            'products' => $products,
            'productList' => $productList
        ];
    }

    public function findProduct($categoryName, $type, $productName)
    {
        $category = Category::where('name', '=', $categoryName)
            ->first();

        if (null !== $type && null !== $categoryName) {
            $categoryID = $category->id;

            $dataFound = Product::where('category_id', $categoryID)
                ->where('type', $type)
                ->where('name', 'like', '%'.$productName.'%')
                ->orderBy('created_at', 'DESC')
                ->paginate(15)
                ->setPath(route('shop.findProduct'))
                ->appends('productName', $productName)
                ->appends('type', $type)
                ->appends('category', $categoryName);
        }
        if (null !== $type && null === $categoryName) {
            $dataFound = Product::where('type', $type)
                ->where('name', 'like', '%'.$productName.'%')
                ->orderBy('created_at', 'DESC')
                ->paginate(15)
                ->setPath(route('shop.findProduct'))
                ->appends('productName', $productName)
                ->appends('type', $type);
        }
        if (null === $type && null === $categoryName) {
            $productNameSplit = explode(' ', $productName);

            $dataFound = Product::where(function ($like) use ($productNameSplit) {
                foreach ($productNameSplit as $item) {
                    $like->Where('name', 'like', "%{$item}%");
                }
            })->paginate(15)
            ->setPath(route('shop.findProduct'))
            ->appends('productName', $productName);
        }

        return $dataFound;
    }

    public function searchProduct($search)
    {
        $productNameSplit = explode(' ', $search);
        $dataFound = Product::where(function ($like) use ($productNameSplit) {
            foreach ($productNameSplit as $item) {
                $like->Where('name', 'like', "%{$item}%");
            }
        })->get();
        $arrSearch = [];
        foreach ($dataFound as $item) {
            $arrSearch[] = $item->name;
        }
        $arrSearchUnique = array_unique($arrSearch);

        return $arrSearchUnique;
    }



    public function getRelatedProduct($productID, $product)
    {
        $relatedProducts = Product::where('id', '!=', $productID)
            ->where('type', $product->type)
            ->where('category_id', $product->category_id)
            ->orderBy('created_at', 'DESC')
            ->take(4)
            ->get();

        return $relatedProducts;
    }

    public function updateProductSoldout($id)
    {
        $productDetails = ProductDetail::where('product_id', $id)->get();
        $sum = 0;
        foreach ($productDetails as $productDetail) {
            $sum += $productDetail->sold_out;
        }
        $productUpdateSolout = $this->update($id, ['sold_out' => $sum]);

        return $productUpdateSolout;
    }

    public function productOutStock()
    {
        $productOutStock = $this->model
            ->orderBy('sold_out', 'DESC')
            ->take(3)
            ->get();

        return $productOutStock;
    }


    public function createOrUpdate($attribute = [])
    {
        $existProduct = $this->model
            ->where('name', $attribute['name'])
            ->where('image', $attribute['image'])
            ->first();
        if ($existProduct) {
            $updateProduct = $this->update($existProduct->id, ['price' => $attribute['price']]);

            return $updateProduct;
        }

        $createProduct = $this->create($attribute);

        return $createProduct;
    }

    public function getProductPagination()
    {
        $products = $this->model->orderBy('created_at', 'DESC')->paginate(10, ['*'], 'np');

        return $products;
    }

    public function getProductSoldOut()
    {
        $products = $this->model->orderBy('sold_out', 'DESC')->get();

        return $products;
    }
}
