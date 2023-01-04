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
        $products = Product::where('type', $type)->get();

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
                ->get();
        }
        if (null !== $category && null === $type) {
            $products = $this->model
                ->where('category_id', $category->id)
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
        $allCategories = Category::all();
        $allProducts = Product::all();

        $category = Category::where('name', '=', $categoryName)
            ->first();

        if (null !== $type && null !== $categoryName) {
            $categoryID = $category->id;

            $dataFound = Product::where('category_id', $categoryID)
                ->where('type', $type)
                ->where('name', 'like', '%'.$productName.'%')
                ->get();
        }
        if (null !== $type && null === $categoryName) {
            $dataFound = Product::where('type', $type)
            ->where('name', 'like', '%'.$productName.'%')
            ->get();
        }

        return [
            'dataFound' => $dataFound,
            'allCategories' => $allCategories,
            'allProducts' => $allProducts
        ];
    }

    public function getRelatedProduct($productID, $product)
    {
        $relatedProducts = Product::where('id', '!=', $productID)
            ->where('type', $product->type)
            ->where('category_id', $product->category_id)
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
}
