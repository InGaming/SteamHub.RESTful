<?php

namespace App\Http\Requests\Game;

use Illuminate\Foundation\Http\FormRequest;

class GameHotQuery extends FormRequest
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
            'current' => 'filled|string',
            'total' => 'filled|string',
            'date' => 'filled|string',
            'length' => 'filled|numeric|min:1|max:100',
            'simple_paginate' => 'filled|boolean',
            'order' => 'required_with:order_field|alpha|in:asc,desc',
            'order_field' => 'required_with:order|alpha_dash|in:current,total,created_at,updated_at'
        ];
    }
}
