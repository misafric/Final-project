<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ArticleTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    
        $table_name = 'article_tag';
        
        DB::table($table_name)->truncate();

        $fields = [
            'article_id',
            'tag_id'
        ];

        $values = [
            [1,3],
            [1,5],
            [1,7],
            [2,3],
            [2,6],
            [2,8],
            [3,4],
            [3,5],
            [3,7],
            [4,4],
            [4,6],
            [4,8],
            [5,3],
            [5,5],
            [5,7],
            [6,3],
            [6,6],
            [6,8],
            [7,4],
            [7,5],
            [7,7],
            [7,9],
            [8,4],
            [8,6],
            [8,8],
            [8,9],
            [9,3],
            [9,5],
            [9,7],
            [10,3],
            [10,6],
            [10,8],
            [11,4],
            [11,5],
            [11,7],
            [12,4],
            [12,6],
            [12,8],
        ];

        $fields_string = implode(',', $fields);

        $values_string = [];

        foreach ($values as $value_set) {
            foreach ($value_set as $value) {
                array_push($values_string,$value);
            }
        }

        $qm_array = [];
        foreach ($values as $value_set) {
            $qm_array[] = '('.implode(',',array_fill(0,count($value_set),'?')).')';
        }
        

        $qm_string = implode(',',$qm_array);

        $query = 'insert into '.$table_name.' ('.$fields_string.') values '.$qm_string;

        DB::insert($query, $values_string);
    }
}
