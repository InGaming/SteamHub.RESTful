<?php

namespace App\Http\Requests\Game;

use Illuminate\Foundation\Http\FormRequest;

class GameListQuery extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'q' => 'filled|string',
            'appids' => 'filled|string',
            'free' => 'filled|boolean',
            'age' => 'filled|string',
            'type'  =>  'filled|string',
            'price_final' => 'filled|numeric|min:1|max:1000000',
            'price_initial' => 'filled|numeric|min:1|max:1000000',
            'price_discount' => 'filled|numeric|min:1|max:100',
            'metacritic_review_score' => 'filled|string',
            'metacritic_review_link'  => 'filled|url',
            'steam_user_review_score' => 'filled|string',
            'steam_user_review_count' => 'filled|string',
            'steam_user_review_summary' => 'filled|string',
            'language' =>  'filled|string',
            'platform' => 'filled|alpha|in:windows,linux,mac',
            'developer' => 'filled|string',
            'publisher' => 'filled|string',
            'length' => 'filled|numeric|min:1|max:100',
            'simple_paginate' => 'filled|boolean',
            'order' => 'required_with:order_field|alpha|in:asc,desc',
            'order_field' => 'required_with:order|alpha_dash|in:age,price_final,price_initial,price_discount,metacritic_review_score,steam_user_review_score,steam_user_review_count,released_at,created_at,updated_at'
        ];
    }
}
