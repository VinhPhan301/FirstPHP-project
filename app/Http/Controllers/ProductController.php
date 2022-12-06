<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Repositories\Product\ProductRepositoryInterface;
use App\Constants\CommonConstant;
use App\Constants\ProductConstant;

class ProductController extends Controller
{
    protected $productRepo;

    public function __construct(ProductRepositoryInterface $productRepo)
    {
        $this->productRepo = $productRepo;
    }

    public function index()
    {
        $products = $this->productRepo->getAll();

        if (!$products || null === $products) {
            return redirect()
                ->route('user.viewpage')
                ->with(CommonConstant::MSG, ProductConstant::MSG['not_found']);
        }

        return view('product.list', [
            'product' => $products,
            'msg' => session()->get(CommonConstant::MSG) ?? null
        ]);
    }

    public function getViewCreate()
    {      
        return view('product.create',[
            'msg' => session()->get(CommonConstant::MSG) ?? null
        ]);
    }

    public function create(Request $request)
    {
        $product = $this->productRepo->create($request->toArray());

        if (!$product || null === $product) {
            return redirect()
                ->route('product.create')
                ->with(CommonConstant::MSG, ProductConstant::MSG['not_found']); 
        }

        return redirect()
            ->route('product.list')
            ->with(CommonConstant::MSG, ProductConstant::MSG['create_success']);
    }

    public function delete($id)
    {
        $product = $this->productRepo->delete($id);

        if (!$product || null === $product) {
            return redirect()
                ->route('product.list')
                ->with(CommonConstant::MSG, ProductConstant::MSG['not_found']);
        }
        
        return redirect()
            ->route('product.list')
            ->with(CommonConstant::MSG, ProductConstant::MSG['delete_success']);
    }

    public function getViewUpdate($id)
    {
        $product = $this->productRepo->find($id);

        if (! $product || null == $product) { 
            return redirect()
                ->route('product.list')
                ->with(CommonConstant::MSG, ProductConstant::MSG['not_found']); 
        }
       
        return view('product.update', ['product' => $product]);

    }

    public function update(Request $request, $id)
    {
        $product = $this->productRepo->update($id, $request->toArray());

        if (!$product || null === $product) {
            return redirect()
                ->route('product.list')
                ->with(CommonConstant::MSG, ProductConstant::MSG['not_found']);
        }
        
        return redirect()
            ->route('product.list')
            ->with(CommonConstant::MSG, ProductConstant::MSG['update_success']);
    }

    
}



