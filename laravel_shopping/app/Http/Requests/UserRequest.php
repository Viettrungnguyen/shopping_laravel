<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'name' => 'required|max:25|unique:users,name,' . $this->id,
            'email' => 'required|email|unique:users,email,' . $this->id,
            'password' => 'required',
            'title' => 'required|max:255',
            'gender' => 'required',
            'avatar_url' => 'required',
            'education' => 'required',
            'location' => 'required|max:255',
            'skills' => 'required|max:255',
            'note' => 'required|max:255',
            'birthday' => 'required',
            'is_active' => 'required',
            'role' => 'required',
            'phone' => 'required|regex:/[0-9]{10}/'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Vui lòng nhập tên',
            'name.max:25' => 'Tên dài quá 25 ký tự',
            'name.unique:users' => 'Tên đã tồn tại',
            'email.required' => 'Vui lòng nhập email',
            'email.email' => 'Địa chỉ email không hợp lệ',
            'name.unique' => 'Email đã tồn tại',
            'password.required' => 'Vui lòng nhập mật khẩu',
            'title.required' => 'Vui lòng nhập tiêu đề',
            'title.max:255' => 'Tiêu đề dài quá 255 ký tự',
            'gender.required' => 'Vui lòng chọn giới tính',
            // 'avatar_url.required' => 'Vui lòng thêm avatar',
            'education.required' => 'Vui lòng nhập tên',
            'skills.required' => 'Vui lòng nhập skills',
            'note.required' => 'Vui lòng nhập note',
            'note.max:255' => 'Note dài quá 255 ký tự',
            'birthday.required' => 'Vui lòng nhập ngày sinh',
            'is_active.required' => 'Vui lòng chọn trạng thái hoạt động',
            'phone.required' => 'Vui lòng nhập số điện thoại',
            'phone.regex' => 'Số điện thoại không chính xác',
            'role.required' => 'Vui lòng nhập số role',
        ];
    }
}
