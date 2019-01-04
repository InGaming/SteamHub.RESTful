<?php

namespace App\Http\Requests\Game;

use Illuminate\Foundation\Http\FormRequest;

class GameTagQuery extends FormRequest
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
            'tag' => 'filled|string',
            'language' => 'filled|string|in:schinese',
            'length' => 'filled|numeric|min:1|max:100',
            'simple_paginate' => 'filled|boolean',
            'order' => 'required_with:order_field|alpha|in:asc,desc',
            'order_field' => 'required_with:order|alpha_dash|in:created_at,updated_at'
        ];
    }
}
