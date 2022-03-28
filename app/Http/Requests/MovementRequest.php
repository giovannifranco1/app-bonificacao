<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class MovementRequest extends FormRequest
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
      'movement_type' => [
        'required',
        Rule::in('income', 'expense'),
      ],
      'value' => [
        'numeric',
        'required',
        'min:0',
      ],
      'note' => [
        'nullable',
      ],
    ];
  }
}
