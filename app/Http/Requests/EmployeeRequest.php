<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class EmployeeRequest extends FormRequest
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
  public function rules(): array
  {
    return [
      'full_name' => [
        'required',
        'max:300',
        'min:0',
        'string',
      ],
      'login' => [
        'required',
        'string',
        'max:300',
        'min:0',
        Rule::unique('employee', 'login')
          ->ignore($this->id),
      ],
      'password' => [
        'confirmed',
        Rule::requiredIf(fn() => !$this->id),
        Rule::when($this->id, 'nullable'),
        Password::min(8)
          ->letters()
          ->numbers()
          ->symbols()
          ->mixedCase()
          ->uncompromised(),
      ],
    ];
  }
}
