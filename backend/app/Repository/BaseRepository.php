<?php

namespace App\Repository;

use App\Models\Discount;

class BaseRepository implements IRepository
{
    protected $model;

    public function __construct($model)
    {
        $this->model = $model;
    }
    public function All()
    {
        return $this->model->all();
    }
    public function Create(array $data)
    {
        return $this->model->create($data);
    }
    public function Update(array $data, $slug)
    {
        return $this->model->where('product_slug', $slug)->update($data);
    }
    public function Delete($slug)
    {
        return $this->model->where('product_slug', $slug)->delete();
    }
    public function Show($slug)
    {
        return $this->model->where('product_slug', $slug)->first();
    }
}
