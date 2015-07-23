<?php namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\Product;

class OrderRequest extends Request {

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
		$max = 10;
		if ($this->get('product_id')) {
			$product = Product::find($this->get('product_id'));
			if ($product) {
				$max = $product->quantity;
			}
		}
		return [
			'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|between:1,' . $max
		];
	}

}
