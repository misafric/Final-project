<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ArticleOrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    
        $table_name = 'article_order';
        
        DB::table($table_name)->truncate();

        $fields = [
            'article_id',
            'order_id',
            'order_qty',
            'order_unit_price'
        ];

        $values = [
            [2,1,1,3400],
            [6,2,1,3300],
            [10,2,1,2700],
            [1,3,2,3400],
            [1,4,1,3400],
            [7,5,3,3300],
            [9,6,1,2700],
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
