<?php

namespace App\Http\Requests\Game;

use Illuminate\Foundation\Http\FormRequest;

class GamePriceQuery extends FormRequest
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
            'appids' => 'filled|string',
            'country' => 'filled|string|in:china',
            'final' => 'filled|numeric|min:1|max:1000000',
            'initial' => 'filled|numeric|min:1|max:1000000',
            'discount' => 'filled|numeric|min:1|max:100',
            'length' => 'filled|numeric|min:1|max:100',
            'simple_paginate' => 'filled|boolean',
            'order' => 'required_with:order_field|alpha|in:asc,desc',
            'order_field' => 'required_with:order|alpha_dash|in:final,initial,discount,created_at,updated_at'
        ];
    }
}
