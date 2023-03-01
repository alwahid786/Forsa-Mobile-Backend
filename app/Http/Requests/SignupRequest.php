<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Http\Traits\ResponseTrait;

class SignupRequest extends FormRequest
{
    use ResponseTrait;
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
        // dd($this->attributes);
        $rules = [
            'name' => 'required|max:255|string',
            'last_name' => 'required|max:255|string',
            'username' => 'required|string|unique:users,username',
            'email' => 'required|email|regex:/(.+)@(.+)\.(.+)/i|unique:users,email',
            'password' => 'required|confirmed|min:8',
            'password_confirmation' => 'required',
            'country' => 'required|string',
            'phone' => 'required|string|min:7|max:15',
            'is_business' => 'required|boolean',
        ];
        if ($this->is_business == 1) {
            $rules['business_name'] = 'required|string';
            $rules['business_tagline'] = 'required|string';
            $rules['business_description'] = 'required|string';
        }
        return $rules;
    }

    // Validation Error Response 
    protected function failedValidation(Validator $validator)
    {
        $errors = $this->sendError(implode(",", $validator->errors()->all()));
        throw new HttpResponseException($errors, 422);
    }
}
