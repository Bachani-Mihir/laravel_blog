<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginFormRequest extends FormRequest
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
            'email' => 'required|exists:users',
            'password' => 'required',
        ];
    }

    public function authenticate()
    {
        $credentials = $this->only('email', 'password');
        $remember = request()->filled('remember');

        if (@auth()->attempt($credentials, $remember)) {
            if (@auth()->user()->role == 'admin') {
                return 'admin';
            } elseif (@auth()->user()->role == 'user') {
                return 'user';
            }
        } else {
            return false;
        }
    }
}
