<?php

use Illuminate\Database\Seeder;
use App\Model\Game\GameReview;

class GameReviewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(GameReview::class, 500)->create()->each(function ($u) {
            $u->make();
        });
    }
}
