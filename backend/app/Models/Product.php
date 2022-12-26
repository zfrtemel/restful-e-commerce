<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_name',
        'product_description',
        'product_price',
        'product_quantity',
        'product_status',
        'product_slug',
        'product_code',
        'product_tags',
    ];
    protected $appends = ["images", "categories"];

    public function getImagesAttribute()
    {
        return Image::where('product_id', $this->id)->get();
    }
    public function getCategoriesAttribute()
    {
        return Category::where('id', $this->category_id)->first();
    }
    public function getProductPriceAttribute()
    {
        $discounts = Discount::where('discount_type', 1)->where('discount_status', 1)->get();
        $discount_price = number_format($this->attributes['product_price'], 2);
        foreach ($discounts as $disc_key => $discount) {
            foreach ($this->fillable as $key => $value) {
                if ($value == $discount->target_column) {
                    $discount_price -= number_format($discount_price, 2) * number_format($discount->discount_amount, 2) / 100;
                }
            }
        }
        
        return number_format($discount_price, 2);
    }
}
