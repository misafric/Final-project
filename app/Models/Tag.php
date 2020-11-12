<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Article;
use App\Models\Product;
use App\Models\TagCategory;

class Tag extends Model
{
    use HasFactory;

    public function articles()
    {
        return $this->belongsToMany(Article::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    public function tag_category()
    {
        return $this->belongsTo(TagCategory::class);
    }

}
