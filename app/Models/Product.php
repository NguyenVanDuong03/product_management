<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'category_id', 'image', 'description', 'price', 'stock', 'supplier_email'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
