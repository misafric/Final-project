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
            'name','slug','is_product_level','is_identifier','is_filterable','is_visible'
        ];

        $values = [
            ['Category','category',1,0,0,0],
            ['Color','color',0,1,1,0],
            ['Shoe Size','shoe-size',0,1,1,0],
            ['Sale','sale',0,0,0,1],
            ['Miscellaneous','miscellaneous',0,0,0,1],
            ['Miscellaneous hidden','miscellaneous-hidden',0,0,0,0],
            ['Subcategory','subcategory',1,0,1,0],
            ['Brand','brand',1,0,1,0],
            ['Size','size',0,1,1,0],
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