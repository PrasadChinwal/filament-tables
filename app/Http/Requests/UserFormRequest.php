<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class UserFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return $this->user()->hasAnyRole(['super admin', 'admin']);
    }

    /**
     * Add password field
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'password' => 'shibboleth',
            'name' => Str::of($this->first_name)->append($this->last_name)->value()
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name' => 'required',
            'last_name' => 'required',
            'name' => 'required',
            'email' => 'required',
            'netid' => 'required',
            'uin' => 'required',
            'role' => 'sometimes',
        ];
    }
}
