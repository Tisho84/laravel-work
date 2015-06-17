<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class UserCreateRequest extends Request {

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
			'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'username' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'phone' => 'max:255|regex:/^[0-9]{3}-[0-9]{4}-[0-9]{4}$/',
            'password' => 'required|confirmed|min:6'
		];
	}
    
    public function messages()
    {
        return [
            'first_name.required' => 'first name requred test',
            'phone.regex' => 'Phone is not valid',
            'username.required' => 'test requred username'
        ];
    }

}
