<?php

use Illuminate\Database\Seeder;
use App\Model\Game\GamePrice;

class GamePriceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(GamePrice::class, 500)->create()->each(function ($u) {
            $u->make();
        });
    }
}
