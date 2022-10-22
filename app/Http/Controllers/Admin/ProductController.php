<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\FileHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Models\Product;
use App\Repositories\CategoryRepository;
use App\Repositories\ProductRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    private $productRepository, $categoryRepository;

    public function __construct(
        ProductRepository $productRepository,
        CategoryRepository $categoryRepository
    ) {
        $this->productRepository = $productRepository;
        $this->categoryRepository = $categoryRepository;
    }

    public function index(Request $request)
    {
        $products = $this->productRepository->get([
            'paginate' => 5,
            'order' => 'DESC',
            'search' => [
                'name' => $request->name
            ]
        ]);

        return view('pages.backend.products.index', [
            'products' => $products
        ]);
    }

    public function create()
    {
        $product = new Product();
        $categories = $this->categoryRepository->get();

        return view('pages.backend.products.create', [
            'product' => $product,
            'categories' => $categories
        ]);
    }

    public function store(ProductStoreRequest $request)
    {
        $request->merge([
            'slug' => Str::slug($request->name),
            'status' => Product::STATUS_AVAILABLE
        ]);

        try {
            DB::beginTransaction();

            $file = FileHelper::store($request->file('file'), 'products');
            $request->merge(['file_id' => $file->id]);

            $data = $request->only([
                'name', 'slug', 'description', 'price',
                'status', 'category_id', 'file_id'
            ]);

            $product = new Product();
            $this->productRepository->store($product->fill($data));

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();

            return redirect()->back()->withErrors([
                'errors' => $th->getMessage()
            ]);
        }

        return redirect()->route('admin.products.index')->with([
            'success' => 'Product successfully created.'
        ]);
    }

    public function edit(Product $product)
    {
        $categories = $this->categoryRepository->get();

        return view('pages.backend.products.edit', [
            'product' => $product,
            'categories' => $categories
        ]);
    }

    public function update(ProductUpdateRequest $request, Product $product)
    {
        $request->merge([
            'slug' => Str::slug($request->name)
        ]);

        try {
            DB::beginTransaction();

            if ($request->hasFile('file')) {
                $file = FileHelper::store($request->file('file'), 'products');
                $request->merge(['file_id' => $file->id]);

                if ($product->file_id !== null) {
                    Storage::disk('public')->delete($product->file->locationFile);
                }
            } else {
                $request->merge(['file_id' => $product->file_id]);
            }

            $data = $request->only([
                'name', 'slug', 'description', 'price',
                'status', 'category_id', 'file_id'
            ]);

            $this->productRepository->store($product->fill($data));

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();

            return redirect()->back()->withErrors([
                'errors' => $th->getMessage()
            ]);
        }

        return redirect()->route('admin.products.index')->with([
            'success' => 'Product successfully updated.'
        ]);
    }

    public function destroy(Product $product)
    {
        try {
            DB::beginTransaction();

            $product->delete();

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();

            return redirect()->back()->withErrors([
                'errors' => $th->getMessage()
            ]);
        }

        return redirect()->route('admin.products.index')->with([
            'success' => 'Product successfully deleted.'
        ]);
    }

    public function changeStatus(Request $request, Product $product)
    {
        try {
            DB::beginTransaction();

            if ($product->status == Product::STATUS_AVAILABLE) {
                $request->merge(['status' => Product::STATUS_NOT_AVAILABLE]);
            } else {
                $request->merge(['status' => Product::STATUS_AVAILABLE]);
            }

            $data = $request->only(['status']);

            $this->productRepository->store($product->fill($data));

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();

            return redirect()->back()->withErrors([
                'errors' => $th->getMessage()
            ]);
        }

        return redirect()->route('admin.products.index')->with([
            'success' => 'Product successfully updated.'
        ]);
    }
}
