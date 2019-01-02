<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\{ SerializesModels, InteractsWithQueue };
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Redis;
use QL\QueryList;
use Carbon\Carbon;
use App\Model\Game\{
    GameList as GameListModel,
    GamePrice as GamePriceModel
};
use GuzzleHttp\Exception\RequestException;

class FetchGameList implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $appid;
    protected $name;

    /**
     * Create a new job instance.
     *
     * @param $appid
     * @param $name
     */
    public function __construct($appid, $name)
    {
        $this->appid = $appid;
        $this->name = $name;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $appid = $this->appid;
        $name = $this->name;
        $rules = [
            'type' => ['.block_content_inner .details_block:eq(0) a:eq(0)', 'text'],
            'metacritic_review_score' => ['#game_area_metascore .score.high', 'text'],
            'metacritic_review_link' => ['#game_area_metalink a', 'href'],
            'steam_user_review_summary' => ['.user_reviews_summary_row .summary span:eq(0)', 'text'],
            'steam_user_review_count' => ['.user_reviews_summary_row .summary span:eq(1)', 'text'],
            'steam_user_review_score' => ['.user_reviews_summary_row .summary span:eq(2)', 'text'],
            'released_at' => ['.release_date .date', 'text'],
        ];

        Redis::throttle('FetchGameList')->allow(70)->every(60)->then(function () use ($appid, $name, $rules) {
            $store_url = 'https://store.steampowered.com/app/';
            $api_url = 'https://store.steampowered.com/api/appdetails?cc=cn&l=schinese&appids=';

            $ql = QueryList::getInstance();

            $ql->bind('myGet',function ($url,$args = null,$otherArgs = []){
                try{
                    $this->get($url,$args,$otherArgs);
                }catch(RequestException $e){
                    $this->setHtml('');
                    echo "Http Error \r\n";
                }
                return $this;
            });

            $fetch_api_data
                = $ql->myGet($api_url. $appid)
                    ->getHtml();

            $api_data = json_decode($fetch_api_data);

            foreach ($api_data as $key=>$item) {
                if (! $item->success) return;
                if (empty($item->data)) return;
                $item_data
                    = $item->data;

                $free
                    = $item_data->is_free ?? null;

                $age
                    = $item_data->required_age ?? null;

                $detailed_description
                    = $item_data->detailed_description ?? null;

                $short_description
                    = $item_data->short_description ?? null;

                $chunk_languages
                    = strtr($item_data->supported_languages,array(' '=>'')) ?? null;

                $languages
                    = implode('|', explode(',', $chunk_languages)) ?? null;

                $chunk_platforms
                    = $item_data->platforms
                    ?? null;

                $platforms_windows
                    = $chunk_platforms->windows
                        ? '|windows'
                        : null;

                $platforms_linux
                    = $chunk_platforms->linux
                        ? '|linux'
                        : null;

                $platforms_mac
                    = $chunk_platforms->linux
                    ? '|mac'
                    : null;

                $platforms
                    = implode('|', array_wrap($platforms_windows. $platforms_linux, $platforms_mac)) ?? null;

                $chunk_developers
                    = $item_data->developers ?? null;

                $developers
                    = implode('|', $chunk_developers);

                $chunk_publishers
                    = $item_data->publishers ?? null;

                $publishers
                    = implode('|', $chunk_publishers);

                $country
                    = 'china';

                $price
                    = $item_data->price_overview
                    ?? null;

                $initial
                    = $price->initial
                    ?? null;

                $final
                    = $price->final
                    ?? null;

                $discount
                    = $price->discount_percent
                    ?? null;
            }

            $fetch_store_data
                = $ql->get($store_url. $appid. '?l=schinese')
                    ->rules($rules)
                    ->queryData();

            $store_data
                = $fetch_store_data[0]
                ?? [];

            $type
                = $store_data['type']
                ?? null;


            $metacritic_review_score
                = $store_data['metacritic_review_score']
                ?? null;

            $metacritic_review_link
                = $store_data['metacritic_review_link']
                ?? null;

            $steam_user_review_count
                = array_key_exists('steam_user_review_count', $store_data)
                    ? preg_replace('/\D/s', '', $store_data['steam_user_review_count'])
                    : null;

            if ($steam_user_review_count === "") $steam_user_review_count = null;

            array_key_exists('steam_user_review_score', $store_data)
                ? preg_match('/\d+%/s', $store_data['steam_user_review_score'], $steam_user_review_score_match)
                : null;

            $steam_user_review_score = preg_replace('/\%/s', '', $steam_user_review_score_match[0] ?? null);

            if ($steam_user_review_score === "") $steam_user_review_score = null;

            $steam_user_review_summary
                = $store_data['steam_user_review_summary']
                ?? null;

            array_key_exists('released_at', $store_data)
                ? preg_match_all('/\d+/', $store_data['released_at'] ?? null, $released_at_match)
                : null;

            if (isset($released_at_match)) {
                try {
                    $released_at = Carbon::create($released_at_match[0][0], $released_at_match[0][1] ?? null, $released_at_match[0][2] ?? null, 0, 0, 0)
                        ->toDateTimeString();
                } catch (\Exception $e) {
                    echo $e->getMessage();
                }
            }

            GameListModel::updateOrCreate(
                [ 'appid' => $appid ],
                [
                    'name'  =>  $name,
                    'free'  =>  $free ?? null,
                    'age'   =>   $age ?? null,
                    'type'  =>  $type,
                    'languages'  =>  $languages ?? null,
                    'platforms'  =>  $platforms ?? null,
                    'developers'  =>  $developers ?? null,
                    'publishers'  =>  $publishers ?? null,
                    'detailed_description'  =>  $detailed_description ?? null,
                    'short_description'     =>  $short_description ?? null,
                    'metacritic_review_score'   =>  $metacritic_review_score,
                    'metacritic_review_link'    =>  $metacritic_review_link,
                    'steam_user_review_count'   =>  $steam_user_review_count ?? null,
                    'steam_user_review_score'   =>  $steam_user_review_score ?? null,
                    'steam_user_review_summary'  =>  $steam_user_review_summary,
                    'released_at'  =>  $released_at ?? null,
                ]
            );

            GamePriceModel::updateOrCreate(
                [
                    'appid' =>  $appid,
                    'final'     =>  $final ?? null,
                ],
                [
                    'country'   =>  $country ?? null,
                    'initial'   =>  $initial ?? null,
                    'discount'  =>  $discount ?? null,
                ]
            );
        }, function () {
            return $this->release(10);
        });
    }
}
