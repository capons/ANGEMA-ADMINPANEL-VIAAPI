<?php

namespace App\Http\Requests\Engena\PassTypes;

use App\Http\Requests\Request;

class CreatePassTypeRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return access()->allow('create-pass-types');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|unique:pass_types',
        ];
    }
}
