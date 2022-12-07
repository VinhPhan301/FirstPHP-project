<?php
namespace App\Repositories\Product;
use App\Models\Product;
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

        $category = Category::where('name', $categoryName)->first(); //check lai logic query
        // if (null !== $category) {
        //     $products = $this->model->where('category_id', $category->id);

        //     if(null !== $type) {
        //         $products .= $products->where('type', $type);
        //     }

        //     if(null !== $price) {
        //         $products .= $products->where('price', $price);
        //     }

        //     $products->get();
        // }
        if (null !== $category && null !== $type) {  //check lai dieu kien
            $products = $this->model
                ->where('type', $type)
                ->where('category_id', $category->id)
                ->get();
        }
        if (null !== $category && null === $type){
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

        return [
            'dataFound' => $dataFound,
            'allCategories' => $allCategories, 
            'allProducts' => $allProducts
        ];
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

}


