<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $table_name = 'images';
        
        DB::table($table_name)->truncate();

        $fields = [
            'url'
        ];

        $values = [
            ['timberland-m-black.jpg'],
            ['timberland-m-brown.jpg'],
            ['timberland-f-black.jpg'],
            ['timberland-f-brown.jpg'],
            ['keen-f-black.jpg'],
            ['keen-f-brown.jpg'],
            ['keen-f-brown-second.jpg'],
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