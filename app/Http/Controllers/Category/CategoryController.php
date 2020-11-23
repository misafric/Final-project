<?php

namespace App\Http\Controllers\Category;

use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Tag;
use App\Models\Product;

class CategoryController extends Controller
{
    public function index($id)
    {
        $categories = DB::select('SELECT * FROM `tags` WHERE `tag_category_id` = ? ', [$id]);  

        return view('category/index', compact('categories'));
    }
}
