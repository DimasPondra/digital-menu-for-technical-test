<?php

namespace App\Repositories;

use App\Models\Product;

class ProductRepository
{
    private $model;

    public function __construct(Product $model)
    {
        $this->model = $model;
    }

    public function get($params = [])
    {
        $products = $this->model
            ->when(!empty($params['search']['name']), function ($query) use ($params) {
                return $query->where('name', 'LIKE', '%' . $params['search']['name'] . '%');
            })
            ->when(!empty($params['category_id']), function ($query) use ($params) {
                return $query->where('category_id', $params['category_id']);
            })
            ->when(isset($params['order']), function ($query) use ($params) {
                return $query->orderBy('updated_at', $params['order']);
            });

        if (!empty($params['paginate'])) {
            return $products->paginate($params['paginate']);
        }

        return $products->get();
    }

    public function getBySlug($slug)
    {
        $product = $this->model->where('slug', $slug)->first();

        return $product;
    }

    public function store(Product $product)
    {
        $product->save();

        return $product;
    }
}
