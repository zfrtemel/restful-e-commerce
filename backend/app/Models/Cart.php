<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $fillable = [
        'cart_user_id',
        'cart_product_id',
        'cart_product_quantity',
        'cart_product_subtotal',
    ];
    protected $appends = ["product", "category"];
    public function getProductAttribute()
    {
        return Product::where('id', $this->cart_product_id)->first();
    }
    public function getCategoryAttribute()
    {
        return Category::where('id', $this->product->category_id)->first();
    }
    public function getCartProductSubtotalAttribute($value)
    {
        $discounts = Discount::where('discount_type', "!=", ["1", "2"])->where('discount_status', 1)->get();

        $discount_price = number_format($value, 2);
        $data = collect([$this]);
        //veritabanından aldığımız veriler ile sorgulama yapabilmek için collectiona çevirdik 
        dd($data);
        foreach ($discounts as $disc_key => $discount) {
            if ($discount->discount_type == 3 && $data->where('id', $this->id)->where($discount->target_column, $discount->target_condition, $discount->target_value)->count() > 0) {
          
            } 
            else if ($discount->discount_type == 4 && $data->where('id', $this->id)->where($discount->target_column, $discount->target_condition, $discount->target_value)->count() > 0) {
            
            }
             else if ($discount->discount_type == 5 && $data->where('id', $this->id)->where($discount->target_column, $discount->target_condition, $discount->target_value)->count() > 0) {
            }


            // if ($data->where('id', $this->id)->where($discount->target_column, $discount->target_condition, $discount->target_value)->count() > 0) {
            //     //bu sorgu ise veri tabanından aldığımız datalar ile sorgulama yapılıyor
            //     // kodun optimizesi kontrol edilmeli
            //     $discount_price -= number_format($discount_price, 2) * number_format($discount->discount_amount, 2) / 100;
            // }
        }
        return number_format($discount_price, 2);
    }
}
