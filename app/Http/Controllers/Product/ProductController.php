<?php

namespace App\Http\Controllers\Product;

use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Category\CategoryController;
use App\Http\Controllers\Customer\HomeController;
use App\Models\Tag;
use App\Models\TagCategory;
use App\Models\Product;

class ProductController extends Controller
{

    private $relevant_tag_ids = [];

    public function index($category_id)
    {
        $products = Product::
        whereHas('tags', function($query) use ($category_id) {
            $query->where('tags.id', $category_id);
        })
        ->with('tags')
        ->with('articles.images')
        ->with('articles.tags')
        ->offset(0)
        ->limit(20)
        ->get();

        foreach ($products as $product) {
            foreach ($product['tags'] as $product_tag) {
                $this->relevant_tag_ids = array_unique(array_merge($this->relevant_tag_ids,[$product_tag['id']]));
            }
            ;
        }

        foreach ($products as $product) {
            foreach ($product['articles'] as $article) {
                foreach ($article['tags'] as $article_tag) {
                    $this->relevant_tag_ids = array_unique(array_merge($this->relevant_tag_ids,[$article_tag['id']]));
                }                
            }
            ;
        }

        $filters = TagCategory::
        with(['tags' => function ($query) {
            $query->whereIn('id', $this->relevant_tag_ids)
            ;
        }])
        ->where('is_filterable',1)
        ->whereHas('tags', function($query) {
            $query->whereIn('tags.id', $this->relevant_tag_ids);
        })
        ->orderBy('is_product_level','desc')
        ->get();

        $categories = CategoryController::categories();

        // return $products;

        return view('customer.category',compact('products','filters','category_id','categories'));
    }

    public function filter($category_id, Request $request)
    {
        $active_filters = array_keys($request->all());

        $product_tag_ids_array = [];
        $article_tag_ids_array = [];
        $tag_ids_array = [];

        foreach ($active_filters as $active_filter) {
            if(substr($active_filter,0,strpos ( $active_filter , '-')) == 0) {
                $tag_category_id = substr($active_filter,strpos ( $active_filter , '-')+1,strrpos ( $active_filter , '-') - strpos ( $active_filter , '-')-1);
                if(!in_array($tag_category_id,array_keys($article_tag_ids_array))) {
                    $article_tag_ids_array[$tag_category_id] = [];
                }
                $tag_value = substr($active_filter,strrpos ( $active_filter , '-')+1, strlen($active_filter));
                array_push($article_tag_ids_array[$tag_category_id],$tag_value);
                // array_push($tag_ids,$tag_value);
                $tag_ids_array = array_unique(array_merge($tag_ids_array,[$tag_value]));

            } else {
                $tag_category_id = substr($active_filter,strpos ( $active_filter , '-')+1,strrpos ( $active_filter , '-') - strpos ( $active_filter , '-')-1);
                if(!in_array($tag_category_id,array_keys($product_tag_ids_array))) {
                    $product_tag_ids_array[$tag_category_id] = [];
                }
                $tag_value = substr($active_filter,strrpos ( $active_filter , '-')+1, strlen($active_filter));
                array_push($product_tag_ids_array[$tag_category_id],$tag_value);
            }
        }

        // $tag_ids = [8,9];

        // dd($tag_ids);
        $query = Product::
        whereHas('tags', function($query) use ($category_id) {
            $query->where('tags.id', $category_id);
        })

        
        // Slavo
        // ->with(['articles' => function($query) use ($tag_ids){
        //     $query->whereHas('tags', function($query2) use ($tag_ids) { 
        //         $query2->whereIn('tags.id', $tag_ids);
        //     });
        // }])
        // Slavo end

        // ->with(['tags' => function ($query) {
        //     $query->whereHas('tag_category', function ($query) {
        //         $query->where('is_identifier', 1);
        //     })
        //     ;
        // }])

        // WORKS
        // ->with(['articles' => function ($query) use ($tag_ids){
        //     $query->whereHas('tags', function ($query) use ($tag_ids) {
        //         $query->whereIn('tags.id', $tag_ids);
        //     })
        //     ;
        // }])

        // ->with(['articles.images' => function ($query) {
        //     $query->whereHas('articles.tags', function ($query) {
        //         $query->where('tags.id', 9);
        //     })
        //     ;
        // }])

        // ->with(['articles.tags' => function ($query) {
        //     $query->whereHas('articles.tags', function ($query) {
        //         $query->where('tags.id', 9);
        //     })
        //     ;
        // }])

        ->with('articles.images')
        ->with('articles.tags.tag_category')
        ->offset(0)
        ->limit(20);

        foreach ($product_tag_ids_array as $tag_ids) {
            $query->whereHas('tags', function($query) use ($tag_ids) {
                $query->whereIn('tags.id', $tag_ids);
            });
        }

        foreach ($article_tag_ids_array as $tag_ids) {
            $query->whereHas('articles.tags', function($query) use ($tag_ids) {
                $query->whereIn('tags.id', $tag_ids);
            });
        }

        // Product index method from here;

        $products = $query->get();

        foreach ($products as $product) {
            foreach ($product['tags'] as $product_tag) {
                $this->relevant_tag_ids = array_unique(array_merge($this->relevant_tag_ids,[$product_tag['id']]));
            }
            ;
        }

        foreach ($products as $product) {
            foreach ($product['articles'] as $article) {
                foreach ($article['tags'] as $article_tag) {
                    $this->relevant_tag_ids = array_unique(array_merge($this->relevant_tag_ids,[$article_tag['id']]));
                }                
            }
            ;
        }

        // dd($tag_ids_array);

        foreach ($products as $product) {
            foreach ($product['articles'] as $article) {
                $article['matches'] = 0;
                $article['selected'] = false;
                foreach ($article['tags'] as $tag) {
                    $article['matches'] = in_array($tag['id'], $tag_ids_array) ? $article['matches'] + 1 : $article['matches'];
                }
                $article['selected'] = $article['matches'] === count($article_tag_ids_array);
                if($article['selected']) {break;}
            }
        }

        $filters = TagCategory::
        with(['tags' => function ($query) {
            $query->whereIn('id', $this->relevant_tag_ids)
            ;
        }])
        ->where('is_filterable',1)
        ->whereHas('tags', function($query) {
            $query->whereIn('tags.id', $this->relevant_tag_ids);
        })
        ->orderBy('is_product_level','desc')
        ->get();

        // return $products;

        $categories = CategoryController::categories();

        return view('customer.category',compact('products','filters','category_id','active_filters','categories'));
    }

}