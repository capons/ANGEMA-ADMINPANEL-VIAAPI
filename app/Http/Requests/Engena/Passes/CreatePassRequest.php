<?php

namespace App\Http\Requests\Engena\Passes;

use App\Http\Requests\Request;

class CreatePassRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return access()->allow('create-passes');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'pass_type_id'     => 'required|numeric',
            'pass_duration_id' => 'required|numeric',
            'name'             => 'required|string|unique:passes',
        ];
    }
}
