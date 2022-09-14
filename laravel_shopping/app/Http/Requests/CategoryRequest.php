<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
            'name' => 'required|max:50|unique:categories,name,' . $this->id
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Vui lòng nhập tên loại sản phẩm',
            'name.max:25' => 'Tên dài quá 50 ký tự',
            'name.unique' => 'Tên đã tồn tại',
        ];
    }
}
