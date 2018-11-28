<?php

namespace App\Http\Resources\Game;

use Illuminate\Http\Resources\Json\ResourceCollection;

class GamePrice extends ResourceCollection
{
    /**
     * Transform the resource into an array.
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
