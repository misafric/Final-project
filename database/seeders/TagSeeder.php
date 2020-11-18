<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $table_name = 'tags';
        
        DB::table($table_name)->truncate();

        $fields = [
            'tag_category_id',
            'is_product_tag',
            'name',
            'is_identifier_tag',
            'is_filterable_tag'
        ];
        
        $values = [
            [1,1,'Male',0,0],
            [1,1,'Female',0,0],
            [2,0,'Black',1,1],
            [2,0,'Brown',1,1],
            [3,0,40,1,1],
            [3,0,42,1,1],
            [4,0,'A',0,1],
            [4,0,'B',0,1],
            [5,0,'-30%',0,1],
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
