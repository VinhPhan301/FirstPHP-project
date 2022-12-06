<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Repositories\Product\ProductDetailRepositoryInterface;
use App\Repositories\Product\ProductRepositoryInterface;
use App\Constants\CommonConstant;
use App\Constants\ProductConstant;

class ProductDetailController extends Controller
{
    protected $productDetailRepo;
    protected $productRepo;

    public function __construct(ProductDetailRepositoryInterface $productDetailRepo, ProductRepositoryInterface $productRepo)
    {
        $this->productDetailRepo = $productDetailRepo;
        $this->productRepo = $productRepo;
    }

    public function index($id)
    {
        $productDetail = $this->productDetailRepo->getProductDetail($id);
        $product = $this->productRepo->find($id);

        if (!$productDetail || null === $productDetail) {
            return redirect()
                ->route('product.list')
                ->with(CommonConstant::MSG, ProductConstant::MSG['not_found']);
        }

        return view('productDetail.list', [
            'productDetail' => $productDetail,
            'product' => $product,
            'msg' => session()->get(CommonConstant::MSG) ?? null
        ]);
    }

    public function getViewCreate($id)
    {
        $product = $this->productRepo->find($id);

        return view('productDetail.create', [
            'product' => $product,
            'msg' => session()->get(CommonConstant::MSG) ?? null
        ]);
    }

    public function create(Request $request)
    {

        $productDetail = $this->productDetailRepo->create($request->toArray());
        if (!$productDetail || null === $productDetail) {
            return redirect()
                ->route('product.list')
                ->with(CommonConstant::MSG, ProductConstant::MSG['not_found']);
        }

        return redirect()
            ->route('product.list')
            ->with(CommonConstant::MSG, ProductConstant::MSG['create_success']);
    }

    public function delete($id)
    {
        $productDetail = $this->productDetailRepo->delete($id);

        if (!$productDetail || null === $productDetail) {
            return redirect()
            ->route('productDetail.list',['id' => $id])
            ->with(CommonConstant::MSG, ProductConstant::MSG['not_found']);
      }
        
        return redirect()
            ->route('productDetail.list',['id' => $id])
            ->with(CommonConstant::MSG, ProductConstant::MSG['delete_success']);
    }

    public function getViewUpdate($id)
    {
        $productDetail = $this->productDetailRepo->find($id);
        $product = $this->productRepo->find($productDetail->product_id);

        if (! $productDetail || null == $productDetail) { 
            return redirect()
                ->route('productDetail.list',['id' => $id])
                ->with(CommonConstant::MSG, ProductConstant::MSG['not_found']); 
        }
       
        return view('productDetail.update', [
            'productDetail' => $productDetail,
            'product' => $product,
        ]);

    }

    public function update(Request $request, $id)
    {
        $productDetail = $this->productDetailRepo->update($id, $request->toArray());

        if (!$productDetail || null === $productDetail) {
            return redirect()
                ->route('productDetail.list',['id' => $id])
                ->with(CommonConstant::MSG, ProductConstant::MSG['not_found']);
        }
        
        return redirect()
            ->route('productDetail.list',['id' => $id])
            ->with(CommonConstant::MSG, ProductConstant::MSG['update_success']);
    }
}
