<?php

use Illuminate\Database\Seeder;
use App\Model\Dota\Zhushou\DialogList;

class DialogListsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(DialogList::class, 500)->create()->each(function ($u) {
            $u->make();
        });
    }
}
