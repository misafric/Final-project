<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;    // required, so the Hash::make method can be used
use App\Models\User;                    // required, so that User::create method can be used

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->truncate();

        /**
         * Seeder can also create a record in the table just as we've done earlier
         * in various projects within create methods. However, that only works when
         * models are already created
         * 
         * This code was taken from app/Actions/Fortify/CreateNewUser and is a modification
         * of code Fortify uses to create a new user. The Hash::make method converts the input
         * string to a hash that is stored in DB, meaning that 'h4ck3rm4n' is now functional
         * password for the account 'Admin'. 
         */
        User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.boss',
            'password' => Hash::make('h4ck3rm4n'),      
            'role_id' => '1',
        ]);
    }
}
