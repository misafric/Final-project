<?php

namespace App\Http\Controllers\Category;

use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Tag;
use App\Models\TagCategory;
use App\Models\Product;

class CategoryController extends Controller
{
    public function index($id)
    {
        $categories = DB::select('SELECT * FROM `tags` WHERE `tag_category_id` = ? ', [$id]);  

        return view('category/index', compact('categories'));
    }

    public static function categories()
    {
        if (null !== session('categories')) {
            $categories = session('categories');
        } else {
            $categories = TagCategory::with('tags')->findOrFail(1);
            session('categories',$categories);
        }

        // dd($categories);

        return $categories;
    }
}
