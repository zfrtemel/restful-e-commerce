<?php

namespace App\Repository;

use App\Models\Category;

class CategoryRepository extends BaseRepository implements IRepository
{
    protected $model;
    public function __construct(Category $model)
    {
        self::$model = $model;
        $this->model = $model;
    }
    public static function findParentCategory($id)
    {
        return Category::where('category_parent', $id)->first();
    }

    public static function getCategoryParent($id)
    {
        $category = Category::where('id', $id)->first();
        if ($category->category_parent == 0) {
            return $category;
        } else {
            return self::getCategoryParent($category->category_parent);
        }
    }
}
