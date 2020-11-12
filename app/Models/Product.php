<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Review;
use App\Models\Article;
use App\Models\Tag;

class Product extends Model
{
    use HasFactory;

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function articles()
    {
        return $this->hasMany(Article::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

}
