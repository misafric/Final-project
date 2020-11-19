<?php

namespace App\Http\Controllers\Customer;

use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Tag;


class HomeController extends Controller
{
    public function index()
    {
        $tags = DB::select('SELECT * FROM `tags` WHERE `tag_category_id`=1');

        return view('customer/home', compact('tags'));
    }

}
