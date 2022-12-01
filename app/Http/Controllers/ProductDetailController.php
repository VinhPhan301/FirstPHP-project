<?php

namespace App\Http\Controllers;

use App\Models\ProductDetail;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Repositories\Product\ProductDetailRepositoryInterface;

class ProductDetailController extends Controller
{
    protected $productDetailRepo;

    public function __construct(ProductDetailRepositoryInterface $productDetailRepo)
    {
        $this->productDetailRepo = $productDetailRepo;
    }

    public function index($id)
    {
        $productDetail = $this->productDetailRepo->getProductDetail($id);
        $product = Product::find($id);

        if (!$productDetail || null === $productDetail) {
            return redirect()->back();
        }

        return view('productDetail.list', [
            'productDetail' => $productDetail,
            'product' => $product,
            'msg' => session()->get('msg') 
        ]);
    }

    public function getViewCreate($id)
    {
        $product = Product::find($id);
        return view('productDetail.create',[
            'product' => $product,
            'msg' => session()->get('msg') ?? null
        ]);
    }

    public function create(Request $request)
    {

        $productDetail = $this->productDetailRepo->create($request->toArray());
        if (!$productDetail || null === $productDetail) {
            return redirect()->back();
        }

        return redirect()
            ->back()
            ->with('msg', 'Tao thanh cong ');
    }

    public function delete($id){
        $productDetail = $this->productDetailRepo->delete($id);

        if (!$productDetail || null === $productDetail) {
            return redirect()->back();
        }
        
        return redirect()
            ->back()
            ->with('msg', 'Xoa thanh cong ');
    }

    public function getViewUpdate($id)
    {
        $productDetail = $this->productDetailRepo->find($id);
        $product = Product::find($productDetail->product_id);

        if (! $productDetail || null == $productDetail) { 
            return redirect()
                ->back()
                ->with('msg', 'Khong tim thay product'); 
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
            return redirect()->back();
        }
        
        return redirect()
            ->back()
            ->with('msg', 'Update thanh cong ');
    }
}
