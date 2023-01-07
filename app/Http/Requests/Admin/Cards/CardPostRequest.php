<?php

namespace App\Http\Requests\Admin\Cards;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CardPostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::user()->isAdmin ? true : false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'bail|required|string|max:50|',
            'description' => 'bail|required|string|max:150',
            'price' => 'bail|required|gt:0|numeric',
            'discount_amount' => 'bail|required|between:0,1|numeric',
            'quantity' => 'bail|required|gte:0|numeric',
            'categories' => 'bail|required|array',
            'image.*' => 'image',
        ];
    }
}
