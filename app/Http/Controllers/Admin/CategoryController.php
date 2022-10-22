<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryStoreRequest;
use App\Http\Requests\CategoryUpdateRequest;
use App\Models\Category;
use App\Repositories\CategoryRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    private $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function index(Request $request)
    {
        $categories = $this->categoryRepository->get([
            'paginate' => 5,
            'order' => 'DESC',
            'search' => [
                'name' => $request->name
            ]
        ]);

        return view('pages.backend.categories.index', [
            'categories' => $categories
        ]);
    }

    public function create()
    {
        $category = new Category();

        return view('pages.backend.categories.create', [
            'category' => $category
        ]);
    }

    public function store(CategoryStoreRequest $request)
    {
        $data = $request->only(['name']);

        try {
            DB::beginTransaction();

            $category = new Category();
            $this->categoryRepository->store($category->fill($data));

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();

            return redirect()->back()->withErrors([
                'errors' => $th->getMessage()
            ]);
        }

        return redirect()->route('admin.categories.index')->with([
            'success' => 'Category successfully created.'
        ]);
    }

    public function edit(Category $category)
    {
        return view('pages.backend.categories.edit', [
            'category' => $category
        ]);
    }

    public function update(CategoryUpdateRequest $request, Category $category)
    {
        $data = $request->only(['name']);

        try {
            DB::beginTransaction();

            $this->categoryRepository->store($category->fill($data));

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();

            return redirect()->back()->withErrors([
                'errors' => $th->getMessage()
            ]);
        }

        return redirect()->route('admin.categories.index')->with([
            'success' => 'Category successfully updated.'
        ]);
    }

    public function destroy(Category $category)
    {
        try {
            DB::beginTransaction();

            $category->delete();

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();

            return redirect()->back()->withErrors([
                'errors' => $th->getMessage()
            ]);
        }

        return redirect()->route('admin.categories.index')->with([
            'success' => 'Category successfully deleted.'
        ]);
    }
}
