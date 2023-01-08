<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProductCreateRequest;
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


    /**
     * Show Product List function
     *
     * @return void
     */
    public function index()
    {
        $products = $this->productRepo->getProductPagination();

        if (!$products || null === $products) {
            return redirect()
                ->route('user.viewpage')
                ->with(CommonConstant::MSG, ProductConstant::MSG['not_found']);
        }

        return view('product.list', [
            // compact('products'),
            'product' => $products,
            'msg' => session()->get(CommonConstant::MSG) ?? null
        ]);
    }


    /**
     * Show View Create Product function
     *
     * @return void
     */
    public function getViewCreate()
    {
        return view('product.create', [
            'msg' => session()->get(CommonConstant::MSG) ?? null
        ]);
    }


    /**
     * Create New Product function
     *
     * @param Request $request
     * @return void
     */
    public function create(ProductCreateRequest $request)
    {
        $product = $this->productRepo->createOrUpdate($request->toArray());

        if (!$product || null === $product) {
            return redirect()
                ->route('product.create')
                ->with(CommonConstant::MSG, ProductConstant::MSG['not_found']);
        }

        return redirect()
            ->route('product.list')
            ->with(CommonConstant::MSG, ProductConstant::MSG['create_success']);
    }


    /**
     * Delete Product By ID function
     *
     * @param [type] $id
     * @return void
     */
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


    /**
     * Show View Product Update By ID function
     *
     * @param [type] $id
     * @return void
     */
    public function getViewUpdate($id)
    {
        $product = $this->productRepo->find($id);

        if (! $product || null == $product) {
            return redirect()
                ->route('product.list')
                ->with(CommonConstant::MSG, ProductConstant::MSG['not_found']);
        }

        return view('product.update', [
            'product' => $product
        ]);
    }


    /**
     * Update Product By ID function
     *
     * @param Request $request
     * @param [type] $id
     * @return void
     */
    public function update(ProductCreateRequest $request, $id)
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
