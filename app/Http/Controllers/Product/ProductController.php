<?php

namespace App\Http\Controllers\Product;

use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Tag;
use App\Models\Product;

class ProductController extends Controller
{
    public function index($id)
    {
        $products = DB::select('SELECT * FROM `tags` WHERE `tag_category_id` = ? ', [$id]);  

        return view('product/index', compact('products'));

    }
}
