<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Product\ProductRepositoryInterface;
use App\Repositories\Product\ProductDetailRepositoryInterface;
use App\Constants\CommonConstant;
use Response;

class ShopController extends Controller

{
    protected $productRepo;
    protected $productDetailRepo;

    public function __construct(ProductRepositoryInterface $productRepo, ProductDetailRepositoryInterface $productDetailRepo)
    {
        $this->productRepo = $productRepo;
        $this->productDetailRepo = $productDetailRepo;
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
                'categoryName' => null // thua
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
            
            $products = $this->productRepo->getViewCategory($type, $categoryName);

            return view('shop.view',[
                'type' => $type,
                'productList' => $products['productList'],
                'products' => $products['products'],
                'categoryName' => $categoryName
            ]);
        }

        $products = $this->productRepo->getAll();

        return view('shop.view',[
            'products' => $products,
            'type' => $type,
            'productList' => [],
        ]);
    }

    public function findProduct(Request $request)
    {   
        $categoryName = $request->query('category');
        $type = $request->query('type');
        $productName =$request->query('productName');

        $findProduct = $this->productRepo->findProduct($categoryName, $type, $productName);
        // dd($findProduct);

        return view('shop.findProduct',[
            'dataFound' => $findProduct['dataFound'],
            'type' => $type,
            'categoryName' => $categoryName,
            'allCategories' => $findProduct['allCategories'],
            'allProducts' => $findProduct['allProducts'],
        ]);
    }

    public function getViewProduct(Request $request)
    {
        $productID = $request->query('id');
        $product = $this->productRepo->find($productID);

        $relatedProducts = $this->productRepo->getRelatedProduct($productID, $product);

        $getSizeColor = $this->productDetailRepo->getSizeColor($productID);

        return view('shop.product',[
            'product' => $product,
            'detailSize' => $getSizeColor['sizeUnique'],
            'detailColor' => $getSizeColor['colorUnique'],
            'relatedProducts' => $relatedProducts,
        ]);
    }
}
