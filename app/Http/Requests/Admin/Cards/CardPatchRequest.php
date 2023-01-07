<?php

namespace App\Http\Requests\Admin\Cards;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CardPatchRequest extends FormRequest
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
            'name'            => 'bail|string|max:50|nullable',
            'description'     => 'bail|string|max:150|nullable',
            'price'           => 'bail|gt:0|numeric|nullable',
            'discount_amount' => 'bail|between:0,1|numeric|nullable',
            'quantity'        => 'bail|gte:0|numeric|nullable',
            'categories'      => 'bail|array|nullable',
            'image.*'         => 'image'
        ];
    }
}
