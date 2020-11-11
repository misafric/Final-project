<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ArticleOrderSeeder::class);
        $this->call(ArticleSeeder::class);
        $this->call(ArticleTagSeeder::class);
        $this->call(ProductSeeder::class);
        $this->call(ProductTagSeeder::class);
        $this->call(OrderSeeder::class);
        $this->call(TagSeeder::class);
        $this->call(TagCategorySeeder::class);
    }
}
