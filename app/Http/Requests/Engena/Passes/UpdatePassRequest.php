<?php

namespace App\Http\Requests\Engena\Passes;

use App\Http\Requests\Request;

class UpdatePassRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return access()->allow('update-passes');
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
            'pass_type_id'     => 'required|numeric',
            'pass_duration_id' => 'required|numeric',
            'name'             => "required|string|unique:passes,name,{$id},id",
        ];
    }
}
