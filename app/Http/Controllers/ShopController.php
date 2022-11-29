<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductDetail;
use Illuminate\Http\Request;
use App\Repositories\Product\ProductRepositoryInterface;
use DB;

class ShopController extends Controller

{
    protected $productRepo;

    public function __construct(ProductRepositoryInterface $productRepo)
    {
        $this->productRepo = $productRepo;
    }    

    public function getView(Request $request) 
    {
        $arrProductName = [];
        $type = $request->query('type');
        
        if (null !== $request->query('type')) {
            $products = DB::table('products')
                        ->where('type', $type)
                        ->get();

            foreach ($products as $product) {
                $productNameSplit = explode(' ', $product->name);    
                if ( count($productNameSplit) === 1 ){
                    $productNameJoin = $productNameSplit[0];
                    $arrProductName[] = $productNameJoin;  
                }
                if ( count($productNameSplit) === 2 ){
                    $productNameJoin = $productNameSplit[0]." ".$productNameSplit[1];
                    $arrProductName[] = $productNameJoin;               
                }
                if ( count($productNameSplit) === 3 ){
                    $productNameJoin = $productNameSplit[0]." ".$productNameSplit[1]." ".$productNameSplit[2];
                    $arrProductName[] = $productNameJoin; 
                }
                if ( count($productNameSplit) > 3 ){
                    $productNameJoin = $productNameSplit[0]." ".$productNameSplit[1];
                    $arrProductName[] = $productNameJoin; 
                }   
            }
            $productList = array_unique($arrProductName);

            return view('shop.view',[
                'products' => $products,
                'type' => $type,
                'productList' => $productList,
                'categoryName' => null
            ]);
        }

        $products = Product::all();
        foreach ($products as $product) {
            $arrProductName[] = $product->name;
        }
        $productList = array_unique($arrProductName);

        return view('shop.view',[
            'products' => $products,
            'type' => '',
            'productList' => $productList,
            'categoryName' => null
        ]);
    }

    public function getViewCategory(Request $request)
    {
        $arrProductName = [];
        
        $categoryName = $request->query('category');
        $type = $request->query('type');

        $category = DB::table('categories')
            ->where('name',$categoryName)
            ->get();

        foreach ($category as $item){
            $categoryID = $item->id;
        }
        if (null !== $request->query('category') && null !== $request->query('type')) {
            $products = DB::table('products')
                ->where('type', $type)
                ->where('category_id', $categoryID)
                ->get();

            foreach ($products as $product) {
                $productNameSplit = explode(' ', $product->name);
                $productNameJoin = $productNameSplit[0]." ".$productNameSplit[1];
                $arrProductName[] = $productNameJoin;
            }
            $productList = array_unique($arrProductName); 

            return view('shop.view',[
                'products' => $products,
                'type' => $type,
                'productList' => $productList,
                'categoryName' => $categoryName
            ]);
        }

        if (null !== $request->query('category') && null === $request->query('type')) {
            $products = DB::table('products')
                ->where('category_id', $categoryID)
                ->get();
            
            foreach ($products as $product) {
                $productNameSplit = explode(' ', $product->name);
                $productNameJoin = $productNameSplit[0]." ".$productNameSplit[1];
                $arrProductName[] = $productNameJoin;
            }
            $productList = array_unique($arrProductName); 

            return view('shop.view',[
                'products' => $products,
                'type' => $type,
                'productList' => $productList,
                'categoryName' => $categoryName
            ]);
        }

        $products = $products = Product::all();

        return view('shop.view',[
            'products' => $products,
            'type' => $type,
            'productList' => $productList,
        ]);
    }

    public function findProduct(Request $request)
    {   
        $categoryName = $request->query('category');
        $type = $request->query('type');
        $productname =$request->query('productName');

        $allCategories = Category::all();
        $allProducts = Product::all();

        $category = DB::table('categories')
            ->where('name',$categoryName)
            ->get();

        foreach ($category as $item){
            $categoryID = $item->id;
        }  
    
        if (null !== $type && null !== $categoryName) {
            $dataFound = DB::table('products')
                ->where('category_id', $categoryID)
                ->where('type', $type)
                ->where('name', 'like', '%'.$productname.'%')
                ->get();

            return view('shop.findProduct',[
                'dataFound' => $dataFound,
                'type' => $type,
                'categoryName' => $categoryName,
                'allCategories' => $allCategories,
                'allProducts' => $allProducts,
            ]);
        }

        if (null !== $type && null === $categoryName) {
            $dataFound = DB::table('products')
                ->where('type', $type)
                ->where('name', 'like', '%'.$productname.'%')
                ->get();

            return view('shop.findProduct',[
                'dataFound' => $dataFound,
                'type' => $type,
                'categoryName' => $categoryName,
                'allCategories' => $allCategories,
                'allProducts' => $allProducts,
            ]);

        }
    }

    public function getViewProduct(Request $request)
    {
        $arrSize = [];
        $arrColor = [];

        $productID = $request->query('id');
        $product = Product::find($productID);
        
        $productNameSplit = explode(' ', $product->name);
        $productName = $productNameSplit[0].' '.$productNameSplit[1];
        

        $relatedProducts = Product::where('name', 'like', '%'.$productName.'%')
                                    ->where('id', '!=' ,$productID)
                                    ->where('type', $product->type)
                                    ->take(4)
                                    ->get();

        $productDetails = ProductDetail::where('product_id', $productID)->get();

        foreach ($productDetails as $productDetail){
            $arrSize[] = $productDetail->size;
            $arrColor[] = $productDetail->color;
        }
        $sizeUnique = array_unique($arrSize);
        $colorUnique = array_unique($arrColor);

        return view('shop.product',[
            'product' => $product,
            'detailSize' => $sizeUnique,
            'detailColor' => $colorUnique,
            'relatedProducts' => $relatedProducts,
        ]);
    }

    public function getViewCart()
    {
        return view('shop.cart');
    }
}
