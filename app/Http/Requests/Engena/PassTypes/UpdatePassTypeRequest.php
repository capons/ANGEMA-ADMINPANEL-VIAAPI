<?php

namespace App\Http\Requests\Engena\PassTypes;

use App\Http\Requests\Request;

class UpdatePassTypeRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return access()->allow('update-pass-types');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id = app('request')->input('id');

        return [
            'name' => "required|string|unique:pass_types,name,{$id},id",
        ];
    }
}
