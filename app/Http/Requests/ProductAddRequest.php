<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductAddRequest extends FormRequest
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
            'product_name' => 'bail|required|unique:products,name|max:255',
            'product_price' => 'required|numeric',
            'category' => 'required',
            'contents' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'product_name.required'  => 'Ten san pham khong dc de trong',
            'product_name.unique'  => 'Ten san pham bi trung',
            'product_name.max'  => 'Ten san pham qua dai',
            'contents.required' => 'Vui long nhap content',
            'product_price.required' => 'Vui long nhap gia sp',
            'product_price.numeric' => 'Gia sp khong dc chua ky tu chu',
        ];
    }
}
