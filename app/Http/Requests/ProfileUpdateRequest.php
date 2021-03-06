<?php namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use App\Classes\Rules;

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
        $phone = Rules::getRule('phone');
        $id = Auth::user()->id;
        if(Request::get('id')) {
            $id = Request::get('id');
        }
        //todo if is admin ignore all unique so he can change whatever he wants
        return [
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'username' => 'required|unique:users,username,' . $id,
            'email' => 'required|email|unique:users,email,' . $id,
            'phone' => 'max:255|regex:' . $phone,
            'password' => 'confirmed'
        ];
    }
    
}
