<?php

namespace App\Http\Controllers\Api\Customer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Tag;
use App\Models\TagCategory;

class ArticleController extends Controller
{

    public function product_articles($id,$init_selection = '2-3_3-5')
    {
        $articles_without_keys = Article::with('tags')->with('images')->where('product_id',$id)->get();

        $initial_selection_array = explode('-',$init_selection);

        // dd($initial_selection_array);

        // foreach ($initial_selection_array as $i=>$initial_selection_item) {
        //     $initial_selection_array[$i] = explode('-',$initial_selection_item);
        // }

        // foreach ($initial_selection_array as $initial_selection_item) {
        //     $initial_selection[$initial_selection_item[0]] = $initial_selection_item[1];
        // }

        // dd($initial_selection_array);

        $tag_category_ids = [];
        foreach ($articles_without_keys as $article) {
            foreach ($article['tags'] as $tag) {
                $tag_category_ids = array_unique(array_merge($tag_category_ids,[$tag['tag_category_id']]));
            }
        }

        $tag_categories = TagCategory::with('tags')->whereIn('id',$tag_category_ids)->get();

        // $identifier_tags = TagCategory::with('tags')->whereIn('id',$tag_category_ids)->where('is_identifier',1)->get();

        // dd($identifier_tags);

        $identifier_tags = [];

        $category_identifiers_ids = [];

        foreach ($tag_categories as $tag_category) {
            if ($tag_category['is_identifier'] === 1) {
                    $identifier_tags[] = $tag_category;
                    foreach ($tag_category['tags'] as $tag) {
                    $category_identifiers_ids[] = $tag['id'];
                    $tag['preselected'] = in_array( $tag['id'], $initial_selection_array);
                }
            }
        }

        // dd($identifier_tags);

        // $tag_ids = [];
        $articles = [];
        foreach ($articles_without_keys as $article) {
            $tag_key = [];
            foreach ($article['tags'] as $tag) {
                
                // $tag_ids = array_unique(array_merge($tag_ids,[$tag['id']]));

                if(in_array( $tag['id'],$category_identifiers_ids )) {
                    $tag_key[] = $tag['id'];
                    $tag['is_identifier'] = 1;
                } else {
                    $tag['is_identifier'] = 0;
                }
            }
            $article['tag_key']=implode('-',$tag_key);
            $articles[$article['tag_key']] = $article;  
        }

        

        // $tags = Tag::with('tag_category')->whereIn('id',$tag_ids)->get();

        // dd($articles);

        return ['articles' => $articles,
                // 'tags' => $tags,
                'tag_categories' => $tag_categories,
                'identifier_tags' => $identifier_tags
            ];

        // return compact('articles','tags','tag_categories');
    }
}