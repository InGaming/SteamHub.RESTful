<?php

use Illuminate\Database\Seeder;
use App\Model\Game\GameList;

class GameListsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(GameList::class, 500)->create()->each(function ($u) {
            $u->make();
        });
    }
}
