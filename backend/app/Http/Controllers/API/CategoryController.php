<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends BaseController
{
    public function index()
    {
        $categories = Category::orderBy('id', 'DESC')->get();
        return $this->sendResponse($categories, 'Kategori Listesi Başarıyla Getirildi.');
    }
 
    public function show($id)
    {
        $category = Category::find($id);
        return $this->sendResponse($category, 'Kategori Başarıyla Getirildi.');
    }
    public function update(Request $request, $id)
    {
        $category = Category::find($id);
        $category->update($request->all());
        return $this->sendResponse($category, 'Kategori Başarıyla Güncellendi.');
    }
}
