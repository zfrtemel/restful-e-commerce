<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends BaseController
{
    function ListProducts(Request $request)
    {
        $products = Product::orderBy('id', 'DESC')->get();
        return $this->sendResponse($this->CollectionPagination($products, $request), 'Ürün Listesi Başarıyla Getirildi.');
    }
    function GetProduct(Request $request)
    {
        $product = Product::where('product_slug', $request->slug)->first();
        return $this->sendResponse($product, 'Ürün Başarıyla Getirildi.');
    }
}
