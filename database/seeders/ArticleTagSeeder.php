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
            [1,11],
            [2,5],
            [2,8],
            [2,11],
            [3,6],
            [3,7],
            [3,11],
            [4,6],
            [4,8],
            [4,11],
            [5,5],
            [5,7],
            [5,11],
            
            [6,5],
            [6,8],
            [6,10],
            [6,11],
            [6,12],
            [7,6],
            [7,7],
            [7,12],
            [7,13],
            [8,6],
            [8,8],
            [8,10],
            [8,12],
            [8,13],

            [9,5],
            [9,7],
            [9,12],
            [10,5],
            [10,8],
            [10,12],
            [11,6],
            [11,7],
            [11,12],
            [12,6],
            [12,8],
            [12,12],
            [13,5],
            [13,9],
            [13,12],
            [14,6],
            [14,9],
            [14,12],

            [15,5],
            [16,21],
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
