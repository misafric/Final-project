<?php

namespace App\Http\Controllers\Customer;

use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Category\CategoryController;
use App\Models\Tag;
use App\Models\TagCategory;


class HomeController extends Controller
{
    public function index()
    {
        $tags = DB::select('SELECT * FROM `tags` WHERE `tag_category_id`=1');

        $categories = CategoryController::categories();

        return view('customer/home', compact('tags', 'categories'));
    }

}
