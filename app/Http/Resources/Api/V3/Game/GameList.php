<?php

namespace App\Http\Resources\Api\V3\Game;

use Illuminate\Http\Resources\Json\ResourceCollection;

class GameList extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'data' => $this->collection,
            'version' => [
                'api' => config('app.version')
            ],
            'origin' => [
                'website' => config('app.website_url'),
                'github' => config('app.github_url'),
            ],
        ];
    }
}
