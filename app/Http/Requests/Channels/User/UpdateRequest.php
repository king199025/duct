<?php
/**
 * Created by PhpStorm.
 * User: kirill
 * Date: 02.11.18
 * Time: 13:47
 */

namespace App\Http\Requests\Channels\User;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class UserRequest
 * @package App\Http\Requests\Api\v1\Auth
 * @property string $email
 * @property string $login
 * @property string $password
 * @property string $password_confirmation
 * @property string|null $username
 */
class UpdateRequest extends FormRequest
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
            'email' => 'required|string|max:255|min:3|email|unique:users,id,' . $this->user->id,
            'username' => 'string|max:255|min:3',
            'password' => 'required|string|max:255|min:3',
            'password_confirmation' => 'required_with:password|same:password|min:3'
        ];
    }
}