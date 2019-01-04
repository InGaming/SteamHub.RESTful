<?php

namespace App\Http\Resources\Game;

use Illuminate\Http\Resources\Json\ResourceCollection;

class GameReview extends ResourceCollection
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
