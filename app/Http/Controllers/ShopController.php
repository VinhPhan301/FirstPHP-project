<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Category;
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
                $arrProductName[] = $product->name;
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
                $arrProductName[] = $product->name;
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
                $arrProductName[] = $product->name;
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
        $productID = $request->query('id');
        $product = Product::find($productID);

        return view('shop.product',[
            'product' => $product,
        ]);
    }
}
