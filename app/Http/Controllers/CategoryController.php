<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Product\CategoryRepositoryInterface;

class CategoryController extends Controller
{

    protected $categoryRepo;

    public function __construct(CategoryRepositoryInterface $categoryRepo)
    {
        $this->categoryRepo = $categoryRepo;
    }

    public function index()
    {
        $category = $this->categoryRepo->getAll();
        
        if (! $category || null == $category) { 
            return redirect()
                ->route('user.viewpage')
                ->with('msg', 'Khong tim thay Category'); 
        }

        return view('category.list', [
            'category' => $category,
            'msg' => session()->get('msg') ?? null
        ]);
    }

    public function getViewCreate()
    {
        return view('category.create', [
            'msg' => session()->get('msg') ?? null
       ]);

    }

    public function create(Request $request)
    {
        $category = $this->categoryRepo->create($request->toArray());

        if (! $category || null == $category) { 
            return redirect()
                ->route('category.list')
                ->with('msg', 'Khong tim thay Category'); 
        }

        return redirect()
            ->route('category.list')
            ->with('msg', 'Tao thanh cong ');
    }

    public function getViewUpdate()
    {
        return view('category.update', [
            'msg' => session()->get('msg') ?? null
        ]);
    }

    public function update(Request $request, $id)
    {
        $category = $this->categoryRepo->update($id, $request->toArray());

        if (! $category || null == $category) { 
            return redirect()
                ->back()
                ->with('msg', 'Khong tim thay Category'); 
        }

        return redirect()
            ->route('category.list')
            ->with('msg', 'Update thanh cong ');
    }

    public function delete($id)
    {
        $category = $this->categoryRepo->delete($id);

        if (! $category || null == $category) { 
            return redirect()
                ->back()
                ->with('msg', 'Khong tim thay Category'); 
        }
        
        return redirect()
            ->route('category.list')
            ->with('msg', 'Xoa thanh cong ');
    }
}
