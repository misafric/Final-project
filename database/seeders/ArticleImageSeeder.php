<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ArticleImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    
        $table_name = 'article_image';
        
        DB::table($table_name)->truncate();

        $fields = [
            'article_id',
            'image_id'
        ];

        $values = [
            [1,1],
            [2,1],
            [3,2],
            [4,2],
            [5,3],
            [6,3],
            [7,4],
            [8,4],
            [9,5],
            [10,5],
            [11,6],
            [12,6],
            [14,6],
            [11,7],
            [12,7],
            [14,7],
            [11,8],
            [12,8],
            [14,8],
            [15,9],
            [16,9],
            [17,10],
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
