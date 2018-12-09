<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Jobs\FetchGameList as FetchGameListJob;
use GuzzleHttp\Client;

class FetchGameList extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fetch:game-list';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch games';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @param Client $client
     * @return mixed
     */
    public function handle(Client $client)
    {
        $this->info('fetching...');
        $url = 'https://api.steampowered.com/ISteamApps/GetAppList/v0002';
        $response = $client->get($url);
        $data = json_decode($response->getBody());
        foreach ($data->applist->apps as $key=>$item) {
            $appid = $item->appid;
            $name = $item->name;
            FetchGameListJob::dispatch($appid, $name);
        }
    }
}
