<?php

namespace App\Repositories;

use App\Models\Category;

class CategoryRepository
{
    private $model;

    public function __construct(Category $model)
    {
        $this->model = $model;
    }

    public function get($params = [])
    {
        $categories = $this->model
            ->when(!empty($params['search']['name']), function ($query) use ($params) {
                return $query->where('name', 'LIKE', '%' . $params['search']['name'] . '%');
            })
            ->when(isset($params['order']), function ($query) use ($params) {
                return $query->orderBy('updated_at', $params['order']);
            });

        if (!empty($params['paginate'])) {
            return $categories->paginate($params['paginate']);
        }

        return $categories->get();
    }

    public function store(Category $category)
    {
        $category->save();

        return $category;
    }
}
