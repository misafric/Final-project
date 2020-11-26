<?php

namespace App\Http\Controllers\Customer;

use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Category\CategoryController;
use App\Models\Tag;
use App\Models\TagCategory;


class CartController extends Controller
{
    public function show()
    {
        $categories = CategoryController::categories();

        return view('customer.cart', compact('categories'));
    }

}
