<?php

namespace App\Models;

use App\Repository\CategoryRepository;
use GuzzleHttp\Psr7\Query;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Product extends Model
{
    use HasFactory;

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:m:s',
        'updated_at' => 'datetime:Y-m-d H:m:s',
    ];
    protected $fillable = [
        'product_name',
        'product_description',
        'product_price',
        'product_quantity',
        'product_status',
        'product_slug',
        'category_id',
        'product_stock',
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
        return Category::where('id', $this->category_id)->get();
    }
    public function getProductPriceAttribute($value)
    {
        $discounts = Discount::where('discount_type', 1)->where('discount_status', 1)->get();
        $discount_price = number_format($value, 2);
        $data = collect([$this]);
        //veritabanından aldığımız veriler ile sorgulama yapabilmek için collectiona çevirdik 
        foreach ($discounts as $disc_key => $discount) {
            if ($data->where('id', $this->id)->where($discount->target_column, $discount->target_condition, $discount->target_value)->count() > 0) {
                //bu sorgu ise veri tabanından aldığımız datalar ile sorgulama yapılıyor
                // kodun optimizesi kontrol edilmeli
                $discount_price -= number_format($discount_price, 2) * number_format($discount->discount_amount, 2) / 100;
            }
        }
        return number_format($discount_price, 2);
    }
}


// classda cart ise ekstra if kullan değil ise direk product veya category e ieerişimi oalcak 
// ilişkilerini yapmayı unutma 
//