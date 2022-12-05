<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductDetail;
use Illuminate\Http\Request;
use App\Repositories\Product\ProductRepositoryInterface;
use DB;
use Response;

class ShopController extends Controller

{
    protected $productRepo;

    public function __construct(ProductRepositoryInterface $productRepo)
    {
        $this->productRepo = $productRepo;
    }    

    public function getView(Request $request) 
    {  
        $type = $request->query('type');
        if (null !== $request->query('type')) {

            $products = $this->productRepo->getProductType($type);
            $productList = $this->productRepo->getProductName($type);

            return view('shop.view',[
                'products' => $products,
                'type' => $type,
                'productList' => $productList,
                'categoryName' => null
            ]);
        }

        $products = $this->productRepo->getAll();
        $productList = $this->productRepo->getProductList();

        return view('shop.view',[
            'products' => $products,
            'type' => '',
            'productList' => $productList,
            'categoryName' => null
        ]);
    }

    public function getViewCategory(Request $request)
    {
        $categoryName = $request->query('category');
        $type = $request->query('type');

        if ($categoryName && $type){
            $productList = $this->productRepo->getViewCategory($type, $categoryName)[0];
            $products = $this->productRepo->getViewCategory($type, $categoryName)[1];

            return view('shop.view',[
                'type' => $type,
                'productList' => $productList,
                'products' => $products,
                'categoryName' => $categoryName
            ]);
        }

        $products = $this->productRepo->getAll();

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
        $productName =$request->query('productName');

        $dataFound = $this->productRepo->findProduct($categoryName, $type, $productName)[0];

        $allCategories = $this->productRepo->findProduct($categoryName, $type, $productName)[1];

        $allProducts = $this->productRepo->findProduct($categoryName, $type, $productName)[2];

        return view('shop.findProduct',[
            'dataFound' => $dataFound,
            'type' => $type,
            'categoryName' => $categoryName,
            'allCategories' => $allCategories,
            'allProducts' => $allProducts,
        ]);
    }

    public function getViewProduct(Request $request)
    {
        $productID = $request->query('id');
        $product = $this->productRepo->find($productID);

        $relatedProducts = $this->productRepo->getRelatedProduct($productID, $product);

        $sizeUnique = $this->productRepo->getSizeColor($productID)[0];
        $colorUnique = $this->productRepo->getSizeColor($productID)[1];

        return view('shop.product',[
            'product' => $product,
            'detailSize' => $sizeUnique,
            'detailColor' => $colorUnique,
            'relatedProducts' => $relatedProducts,
        ]);
    }
}
