<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TagCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $table_name = 'tag_categories';
        
        DB::table($table_name)->truncate();

        $fields = [
            'name','is_identifier','is_filterable'
        ];

        $values = [
            ['Category',0,0],
            ['Color',1,1],
            ['Size',1,1],
            ['Article Tag 1',0,1],
            ['Sale',0,1],
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