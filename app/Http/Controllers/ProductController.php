<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Repositories\Product\ProductRepositoryInterface;

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
            return redirect()->back();
        }

        return view('product.list', [
            'product' => $products,
            'msg' => session()->get('msg') ?? null
        ]);
    }

    public function getViewCreate()
    {      
        return view('product.create',[
            'msg' => session()->get('msg') ?? null
        ]);
    }

    public function create(Request $request)
    {
        $product = $this->productRepo->create($request->toArray());

        if (!$product || null === $product) {
            return redirect()->back(); // thieu msg
        }

        return redirect()
            ->route('product.list')
            ->with('msg', 'Tao thanh cong ');
    }

    public function delete($id){
        $product = $this->productRepo->delete($id);

        if (!$product || null === $product) {
            return redirect()->back();
        }
        
        return redirect()
            ->back()
            ->with('msg', 'Xoa thanh cong ');
    }

    public function getViewUpdate($id)
    {
        $product = $this->productRepo->find($id);

        if (! $product || null == $product) { 
            return redirect()
                ->route('product.list')
                ->with('msg', 'Khong tim thay product'); 
        }
       
        return view('product.update', ['product' => $product]);

    }

    public function update(Request $request, $id)
    {
        $product = $this->productRepo->update($id, $request->toArray());

        if (!$product || null === $product) {
            return redirect()->back();
        }
        
        return redirect()
            ->route('product.list')
            ->with('msg', 'Update thanh cong ');
    }

    
}



