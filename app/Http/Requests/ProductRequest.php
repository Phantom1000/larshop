<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
        $rules = [
            'name' => ['required', 'string', 'max:100'],
            'code' => ['required', 'string', 'max:100', 'unique:products,code'],
            'category_id' => ['required', 'integer', 'min:1'],
            'description' => ['required', 'string', 'max:255'],
            'price' => ['required', 'numeric', 'min:1'],
            'count' => ['required', 'numeric', 'min:0'],
            'image' => ['image']
        ];

        if ($this->route()->named('products.update')) {
            $rules['code'][3] .= ',' . $this->route()->parameter('product')->id;
        }

        return $rules;
    }
}
