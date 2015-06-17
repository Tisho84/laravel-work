<?php namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Support\Facades\Auth;

class ProfileUpdateRequest extends Request
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
        $id = Auth::user()->id;
        //todo if is admin ignore all unique so he can change whatever he wants
        return [
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'username' => 'required|unique:users,' . $id,
            'email' => 'required|email|unique:users,email,' . $id,
            'phone' => 'max:255|regex:/^[0-9]{3}-[0-9]{4}-[0-9]{4}$/',
            'password' => 'confirmed'
        ];
    }
    
}
