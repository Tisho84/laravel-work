<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class ProductRequest extends Request {

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
			'category_id' => 'required|exists:categories,id',
            'name' => 'required|max:255|unique:products,name,' . Request::input('id'),
            'description' => 'max:255',
            'quantity' => 'required|digits_between:1,1000',
            'available' => 'boolean',
            'active' => 'boolean',
            'price' => 'required|numeric|between:1,1000000000'
		];
	}

}
