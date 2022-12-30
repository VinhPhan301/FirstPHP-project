<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CategoryRequest;
use App\Repositories\Product\CategoryRepositoryInterface;
use App\Constants\CommonConstant;
use App\Constants\CategoryConstant;
use Illuminate\View\View;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    protected $categoryRepo;

    public function __construct(CategoryRepositoryInterface $categoryRepo)
    {
        $this->categoryRepo = $categoryRepo;
    }

    /**
     * Show Category List function
     *
     * @return View
     */
    public function index(): View
    {
        $category = $this->categoryRepo->getAll();

        if (! $category || null == $category) {
            return redirect()
                ->route('user.viewpage')
                ->with(CommonConstant::MSG, CategoryConstant::MSG['not_found']);
        }

        return view('category.list', [
            'category' => $category,
            'msg' => session()->get(CommonConstant::MSG) ?? null
        ]);
    }

    /**
     * Show View Create Category function
     *
     * @return View
     */
    public function getViewCreate(): View
    {
        return view('category.create', [
            'msg' => session()->get(CommonConstant::MSG) ?? null
       ]);
    }

    /**
     * Create New Category function
     *
     * @param Request $request
     * @return void
     */
    public function create(CategoryRequest $request)
    {
        $file = $request->file('thumbnail');
        $file->move('picture', $file->getClientOriginalName());
        $category = $this->categoryRepo->create([
            'name' => $request->name,
            'thumbnail' => $file->getClientOriginalName()
        ]);
        if (! $category || null == $category) {
            return redirect()
                ->route('category.list')
                ->with(CommonConstant::MSG, CategoryConstant::MSG['not_found']);
        }

        return redirect()
            ->route('category.list')
            ->with(CommonConstant::MSG, CategoryConstant::MSG['create_success']);
    }


    /**
     * Show View Update Category function
     *
     * @param [type] $id
     * @return View
     */
    public function getViewUpdate($id): View
    {
        $category = $this->categoryRepo->find($id);
        // $slug = Str::slug($category->name);
        // $compare = $this->model->where('slug', $slug)->first();
        // dd();
        return view('category.update', [
            'categoryName' => $category->name,
            'categoryThumbnail' => $category->thumbnail,
            'msg' => session()->get(CommonConstant::MSG) ?? null
        ]);
    }

    /**
     * Update Category By ID function
     *
     * @param Request $request
     * @param [type] $id
     * @return void
     */
    public function update(Request $request, $id)
    {
        $category = $this->categoryRepo->update($id, $request->toArray());

        if (! $category || null == $category) {
            return redirect()
                ->route('category.update')
                ->with(CommonConstant::MSG, CategoryConstant::MSG['not_found']);
        }

        return redirect()
            ->route('category.list')
            ->with(CommonConstant::MSG, CategoryConstant::MSG['update_success']);
    }

    /**
     * Delete Category By ID function
     *
     * @param [type] $id
     *
     * @return void
     */
    public function delete($id)
    {
        $category = $this->categoryRepo->delete($id);

        if (! $category || null == $category) {
            return redirect()
                ->route('category.list')
                ->with(CommonConstant::MSG, CategoryConstant::MSG['not_found']);
        }

        return redirect()
            ->route('category.list')
            ->with(CommonConstant::MSG, CategoryConstant::MSG['delete_success']);
    }
}
