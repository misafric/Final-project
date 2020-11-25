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
            'name',
            'slug',
            'is_product_tag',
            'is_identifier_tag',
            'is_filterable_tag'
        ];
        
        $values = [
            [1,'Men','men',1,0,0],
            [1,'Women','women',1,0,0],
            [1,'Children','children',1,0,0],
            [1,'Equipment','equipment',1,0,0],
            [2,'Black','black',0,1,1],
            [2,'Brown','brown',0,1,1],
            [3,40,'40',0,1,1],
            [3,41,'41',0,1,1],
            [3,42,'42',0,1,1],
            [4,'-30%','-30%',0,0,1],
            //10
            [5,'Top Seller','top-seller',0,0,1],
            [5,'Top Reviews','top-reviews',0,0,1],
            [5,'Last Chance','last-chance',0,0,1],
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
