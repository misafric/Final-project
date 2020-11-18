<?php

namespace App\Http\Controllers\Api\Customer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Tag;
use App\Models\TagCategory;

class OrderController extends Controller
{

    public function add(Request $request)
    {
        dd($request['product_id']);
    }
}