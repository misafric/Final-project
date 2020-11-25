<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $table_name = 'countries';
        
        DB::table($table_name)->truncate();

        $fields = [
            'iso_2','name_short'
        ];

        $values = [
            ['CZ','Czechia'],
            ['SK','Slovakia'],
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

        // DB::insert("INSERT INTO `tag_categories` (`name`) VALUES (?,?,?)", ['Category','Color','Size']);


        // DB::insert(
        //     "INSERT INTO `tag_categories`
        //     (`name`)
        //     VALUES
        //     ('Category','Color','Size')"
        //     );
    }
}