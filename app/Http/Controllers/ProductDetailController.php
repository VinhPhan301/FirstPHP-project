<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProductDetailRequest;
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


    /**
     * Show View ProductDetail By ID function
     *
     * @param [type] $id
     * @return void
     */
    public function index($id)
    {
        $productDetail = $this->productDetailRepo->getProductPagination($id);
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


    /**
     * Show View Create New ProductDetail By ProductID function
     *
     * @param [type] $id
     * @return void
     */
    public function getViewCreate($id)
    {
        $product = $this->productRepo->find($id);

        return view('productDetail.create', [
            'product' => $product,
            'msg' => session()->get(CommonConstant::MSG) ?? null
        ]);
    }


    /**
     * Create New ProductDetail function
     *
     * @param Request $request
     * @return void
     */
    public function create(ProductDetailRequest $request)
    {
        $productDetail = $this->productDetailRepo->updateOrCreate($request->toArray());

        if (!$productDetail || null === $productDetail) {
            return redirect()
                ->route('product.list')
                ->with(CommonConstant::MSG, ProductConstant::MSG['not_found']);
        }

        return redirect()
            ->route('product.list')
            ->with(CommonConstant::MSG, ProductConstant::MSG['create_success']);
    }


    /**
     * Delete ProductDetail By ID function
     *
     * @param [type] $id
     * @return void
     */
    public function delete($id)
    {
        $productId = $this->productDetailRepo->find($id)->product_id;
        $productDetail = $this->productDetailRepo->delete($id);

        if (!$productDetail || null === $productDetail) {
            return redirect()
            ->route('productDetail.list', ['id' => $productId])
            ->with(CommonConstant::MSG, ProductConstant::MSG['not_found']);
        }

        return redirect()
            ->route('productDetail.list', ['id' => $productId])
            ->with(CommonConstant::MSG, ProductConstant::MSG['delete_success']);
    }


    /**
     * Show View Update ProductDetail By ID function
     *
     * @param [type] $id
     * @return void
     */
    public function getViewUpdate($id)
    {
        $productDetail = $this->productDetailRepo->find($id);
        $product = $this->productRepo->find($productDetail->product_id);
        if (! $productDetail || null == $productDetail) {
            return redirect()
                ->route('productDetail.list', ['id' => $id])
                ->with(CommonConstant::MSG, ProductConstant::MSG['not_found']);
        }

        return view('productDetail.update', [
            'productDetail' => $productDetail,
            'product' => $product,
        ]);
    }


    /**
     * Update ProductDetail By ID function
     *
     * @param Request $request
     * @param [type] $id
     * @return void
     */
    public function update(ProductDetailRequest $request, $id)
    {
        $productDetail = $this->productDetailRepo->update($id, $request->toArray());

        if (!$productDetail || null === $productDetail) {
            return redirect()
                ->route('productDetail.list', ['id' => $id])
                ->with(CommonConstant::MSG, ProductConstant::MSG['not_found']);
        }

        return redirect()
            ->route('productDetail.list', ['id' => $productDetail->product_id])
            ->with(CommonConstant::MSG, ProductConstant::MSG['update_success']);
    }
}
