<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
  public function rules()
  {
    return [
      'full_name' => ['required', 'max:300', 'min:0', 'string'],
      'login' => ['required', 'string', 'max:300', 'min:0'],
      'password' => ['required', 'string', 'max:200', 'min:0'],
    ];
  }
}
