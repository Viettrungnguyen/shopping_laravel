<?php

namespace App\Http\Requests;

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
        return [
            'name' => 'required|max:100|unique:products,name,' . $this->id,
            'code' => 'required|max:50',
            'description' => 'required|max:500',
            'image_url' => 'required|max:255',
            'price' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Vui lòng nhập tên sản phẩm',
            'name.max' => 'Tên dài quá 100 ký tự',
            'name.unique' => 'Tên đã tồn tại',
            'code.required' => 'Vui lòng nhập mã sản phẩm',
            'code.max' => 'Mã dài quá 50 ký tự',
            'description.required' => 'Vui lòng nhập mô tả',
            'description.max:500' => 'Mô tả dài quá 500 ký tự',
            'image_url.required' => 'Vui lòng chọn ảnh',
            'image_url.max:255' => 'Đường dẫn ảnh sai',
            'price.required' => 'Vui lòng nhập giá sản phẩm',
        ];
    }
}
