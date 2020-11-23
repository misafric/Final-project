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

    public function relevant_tags()
    {
        return $this->hasMany(Tag::class)->where('tags.id',5);
    }

    public function first_tag()
    {
        return $this->hasOne(Tag::class)->orderBy('id','asc')->limit(1);
    }

}
