<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Repositories\CategoryRepository;
use App\Repositories\ProductRepository;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    private $categoryRepository, $productRepository;

    public function __construct(
        CategoryRepository $categoryRepository,
        ProductRepository $productRepository
    ) {
        $this->categoryRepository = $categoryRepository;
        $this->productRepository = $productRepository;
    }

    public function index()
    {
        $categories = $this->categoryRepository->get();

        return view('pages.frontend.home', [
            'categories' => $categories
        ]);
    }

    public function categoryMenu(Category $category)
    {
        $products = $this->productRepository->get([
            'paginate' => 8,
            'order' => 'DESC',
            'category_id' => $category->id
        ]);

        return view('pages.frontend.category-menu', [
            'category' => $category,
            'products' => $products
        ]);
    }

    public function detailMenu(Category $category, $slug)
    {
        $product = $this->productRepository->getBySlug($slug);

        return view('pages.frontend.detail-menu', [
            'category' => $category,
            'product' => $product
        ]);
    }
}
