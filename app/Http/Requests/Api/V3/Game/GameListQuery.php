<?php

namespace App\Http\Requests\Api\V3\Game;

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
            'q' => 'filled',
            'free' => 'filled|boolean',
            'metacritic_score' => 'filled|numeric|min:1|max:100',
            'steam_user_score' => 'filled|numeric|min:1|max:100',
            'platform' => 'filled|alpha|in:windows,linux,mac',
            'length' => 'filled|numeric|min:1|max:100',
            'order' => 'required_with:order_field|alpha|in:asc,desc',
            'order_field' => 'required_with:order|alpha_dash|in:metacritic_score,steam_user_score,released_at,created_at,updated_at'
        ];
    }
}
