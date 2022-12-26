<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    use HasFactory;
    protected $fillable = [
        'discount_name', // indirim adı
        'discount_description', // indirim açıklaması
        'target_column', // hangi kolona işlem olacağı
        'target_condition', // kolona eşit mi büyük mü küçük mü gibi
        'target_value', // kolon değeri
        "discount_amount", // indirim miktarı
        'discount_type', //hangi tabloya işlem olacağı 1 ürün 2 kategori 3 sepet
        'discount_start_date', // indirim başlangıç tarihi
        'discount_end_date', // indirim bitiş tarihi
        'discount_status', // indirim durumu 
    ];
}
