<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Tag;

class TagCategory extends Model
{
    use HasFactory;

    public function tags()
    {
        return $this->hasMany(Tag::class);
    }
}
