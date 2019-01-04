<?php

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
        $this->call([
            GameListsSeeder::class,
            GamePriceSeeder::class,
            GameTagsSeeder::class,
            GameReviewsSeeder::class,
            DialogListsSeeder::class
        ]);
    }
}
