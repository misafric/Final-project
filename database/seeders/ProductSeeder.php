<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    
        $table_name = 'products';
        
        DB::table($table_name)->truncate();

        $fields = [
            'name',
            'description_short',
            'description_long',
            'unit_price'
        ];

        $values = [
            ['Timberland M','Short Description Timberland M','Long Description Timberland M', 3400],
            ['Timberland F','Short Description Timberland F','Long Description Timberland F', 3300],
            ['KEEN F','Short Description KEEN F','Long Description Keen F', 2700],
            ['Rejoice Bandana F','Short Description Rejoice Bandana F','Long Description Rejoice Bandana F', 500],
            ['Thermos','Short Description Thermos','Long Description Thermos', 1000],
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
