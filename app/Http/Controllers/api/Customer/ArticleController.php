<?php

namespace App\Http\Controllers\Api\Customer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Tag;
use App\Models\TagCategory;

class ArticleController extends Controller
{

    private $tags_array = [];

    public function product_articles($id,$init_selection = '2-3_3-5')
    {
        $articles_without_keys = Article::with('tags.tag_category')->with('images')->where('product_id',$id)->get();

        

        $initial_selection_array = explode('-',$init_selection);

        $tag_category_ids = [];
        $tags_array_inside = [];
        foreach ($articles_without_keys as $article) {
            foreach ($article['tags'] as $tag) {
                $tag_category_ids = array_unique(array_merge($tag_category_ids,[$tag['tag_category_id']]));
                $this->tags_array = array_unique(array_merge($this->tags_array,[$tag['id']]));
                $tags_array_inside = array_unique(array_merge($tags_array_inside,[$tag['id']]));
            }
        }

        
        $tag_categories = TagCategory::
        with(['tags' => function ($query) {
            $query->whereIn('id', $this->tags_array);
        }])
        ->whereIn('id',$tag_category_ids)
        ->get();

        $identifier_tags = [];

        $category_identifiers_ids = [];

        foreach ($tag_categories as $tag_category) {
            if ($tag_category['is_identifier'] === 1) {
                    $identifier_tags[] = $tag_category;
                    foreach ($tag_category['tags'] as $i => $tag) {
                            $category_identifiers_ids[] = $tag['id'];
                            $tag['preselected'] = in_array( $tag['id'], $initial_selection_array);                        
                    }
            }
        }

        $articles = [];
        foreach ($articles_without_keys as $article) {
            $article['imgs_count'] = count($article->images);
            $tag_key = [];
            foreach ($article['tags'] as $tag) {
                if(in_array( $tag['id'],$category_identifiers_ids )) {
                    $tag_key[] = $tag['id'];
                    $tag['is_identifier'] = 1;
                } else {
                    $tag['is_identifier'] = 0;
                }
            }
            $article['tag_key']=(implode('-',$tag_key) == '') ? "0" : implode('-',$tag_key);
            $articles[$article['tag_key']] = $article;  
        }

        return ['articles' => $articles,
                'tag_categories' => $tag_categories,
                'identifier_tags' => $identifier_tags
            ];
    }
}