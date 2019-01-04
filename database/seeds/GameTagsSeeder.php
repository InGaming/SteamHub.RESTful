<?php

use Illuminate\Database\Seeder;
use App\Model\Game\GameTag;

class GameTagsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(GameTag::class, 500)->create()->each(function ($u) {
            $u->make();
        });
    }
}
