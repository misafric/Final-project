<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    
        $table_name = 'product_tag';
        
        DB::table($table_name)->truncate();

        $fields = [
            'product_id',
            'tag_id'
        ];

        $values = [
            [1,1],
            [1,15],
            [1,16],
            [2,2],
            [2,15],
            [2,16],
            [3,2],
            [3,15],
            [3,17],
            [4,2],
            [4,14],
            [4,18],
            [5,4],
            [5,22],
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
