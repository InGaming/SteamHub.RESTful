<?php

use Illuminate\Database\Seeder;
use App\Model\Game\GameHot;

class GameHotsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(GameHot::class, 500)->create()->each(function ($u) {
            $u->make();
        });
    }
}
