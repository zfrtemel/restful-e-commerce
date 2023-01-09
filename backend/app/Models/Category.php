<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'category_name',
        'category_description',
        'category_slug',
        'category_status',
        'category_parent',
    ];
    protected $appends = ["parent"];
    public function parent()
    {
        $parent = Category::where('id', $this->category_parent)->first();
        return [
            'id' => $parent->id,
            'category_name' => $parent->category_name,
            'category_description' => $parent->category_description,
            'category_slug' => $parent->category_slug,
            'category_status' => $parent->category_status,
        ];
    }
    public function getParentAttribute()
    {
        return  Category::where('id', $this->category_parent)->first()->parent();
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'category_parent');
    }
}
