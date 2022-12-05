<?php
namespace App\Repositories\Product;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductDetail;
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

        $products = Category::where('name',$categoryName)->first();
        $categoryID = $products->id;

        if (null !== $categoryName && null !== $type) {
            $products = Product::where('type', $type)
                ->where('category_id', $categoryID)
                ->get();
        }
        if (null !== $categoryName && null === $type){
            $products = Product::where('category_id', $categoryID)
                ->get();
        }

        foreach ($products as $product) {
            $productNameSplit = explode(' ', $product->name);
            $productNameJoin = $productNameSplit[0]." ".$productNameSplit[1];
            $arrProductName[] = $productNameJoin;
        }
        $productList = array_unique($arrProductName); 

        return [$productList, $products];
    }

    public function findProduct($categoryName, $type, $productName)
    {

        $allCategories = Category::all();
        $allProducts = Product::all();

        $category = Category::where('name','=',$categoryName)
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

        return [$dataFound, $allCategories, $allProducts];
    }

    public function getRelatedProduct($productID, $product)
    {

        $relatedProducts = Product::where('id', '!=' ,$productID)
                                    ->where('type', $product->type)
                                    ->where('category_id', $product->category_id)
                                    ->take(4)
                                    ->get();

        return $relatedProducts;
    }

    public function getSizeColor($productID)
    {
        $arrSize = [];
        $arrColor = [];
        
        $productDetails = ProductDetail::where('product_id', $productID)->get();

        foreach ($productDetails as $productDetail){
            $arrSize[] = $productDetail->size;
            $arrColor[] = $productDetail->color;
        }
        $sizeUnique = array_unique($arrSize);
        $colorUnique = array_unique($arrColor);

        return [$sizeUnique, $colorUnique];
    }
}


