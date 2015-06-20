<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class AddressRequest extends Request {

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
            'type_id' => 'required|exists:address_types,id',
            'country' => 'required|max:255',
            'city' => 'required|max:255',
            'street' => 'required|max:255',
            'zip' => 'required|max:3|min:1'
		];
	}

}
