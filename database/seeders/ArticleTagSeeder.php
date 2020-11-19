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
            [1,5],
            [1,7],
            [1,10],
            [2,5],
            [2,8],
            [2,10],
            [3,6],
            [3,7],
            [3,10],
            [4,6],
            [4,8],
            [4,10],
            [5,5],
            [5,7],
            [5,10],
            [6,5],
            [6,8],
            [6,9],
            [6,10],
            [6,11],
            [7,6],
            [7,7],
            [7,8],
            [7,11],
            [7,12],
            [8,6],
            [8,8],
            [8,9],
            [8,11],
            [8,12],
            [9,5],
            [9,7],
            [9,11],
            [10,5],
            [10,8],
            [10,11],
            [11,6],
            [11,7],
            [11,11],
            [12,6],
            [12,8],
            [12,11],
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
