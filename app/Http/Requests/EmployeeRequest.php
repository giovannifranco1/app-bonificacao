<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
        'required',
        'string',
        'max:200',
        'min:0',
      ],
    ];
  }
}
