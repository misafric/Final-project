<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    
        $table_name = 'orders';
        
        DB::table($table_name)->truncate();

        $fields = [
            'name',
            'email',
            'street',
            'city',
            'zip',
            'country_id',
            'phone',
            'note',
            'user_id',
            'order_date_time',
            'order_hash'
        ];

        $values = [
            ['Dummy Dummysson','ddummysson@work-email.se','Dummystreet 12', 'Dummytown', '11111', 45, 555444222111,'Just give me my stuff!',1,'2020-11-07 12:02:43','ogqergbaslvbjvdaareg'],
            ['Testilla Testadilla','ttestadilla@taco-bell.mx','Test 13', 'Ciudad de Test', '22222', 89, 555333666222,'Gib!',1,'2020-11-10 14:42:45','wufwlgbqeefqv'],
            ['Testworth Testington','ttestington@yorkshire-tea.com','Teststreet 12', 'Testbarrow', '33333', 160, 555111222111,'Can I have my stuff, please?',1,'2020-11-01 12:32:43','egqrgwrhwrvr'],
            ['Dumm Dummenwald','ddummenwald@bundeswehr.de','Dummstrasse 33', 'Dummenwald', '44444', 23, 555444222555,'Stuff will be sent to me in most efficient manner!',1,'2020-07-18 12:02:43','eogyvnrcogadxerg'],
            ['Testomila Testikova','ttestikova@seznam.cz','Testova 35', 'Cesky Testin', '55555', 12, 555444222111,'',1,'2020-11-13 16:02:43','eorcgunqrogxq'],
            ['Testomila Testikova','ttestikova@seznam.cz','Testova 35', 'Cesky Testin', '55555', 12, 555444222111,'Jo a jeste totok',1,'2020-11-13 16:13:43','eorcgunqrogxq']
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
