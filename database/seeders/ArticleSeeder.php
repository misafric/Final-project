<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    
        $table_name = 'articles';
        
        DB::table($table_name)->truncate();

        $fields = [
            'product_id',
            'stock_qty',
            'next_restock',
            'is_active'
        ];

        $values = [
            [1, 3, '2020-12-20', 1],
            [1, 2, '2020-12-20', 1],
            [1, 4, '2020-12-20', 1],
            [1, 1, '2020-12-20', 1],

            [2, 6, '2020-12-20', 1],
            [2, 2, '2020-12-20', 1],
            [2, 3, '2020-12-20', 1],
            [2, 3, '2020-12-20', 1],

            [3, 6, '2020-12-20', 1],
            [3, 1, '2020-12-20', 1],
            [3, 5, '2020-12-20', 1],
            [3, 2, '2020-12-20', 1],
            [3, 2, '2020-12-20', 1],
            [3, 1, '2020-12-20', 1],

            [4, 15, '2020-12-20', 1],
            [4, 10, '2020-12-20', 1],

            [5, 5, '2020-12-20', 1],
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
