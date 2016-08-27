<?php

namespace App\Http\Requests\Engena\PassDurations;

use App\Http\Requests\Request;

class UpdatePassDurationRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return access()->allow('update-pass-durations');
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
            'name'            => "required|string|unique:pass_durations,name,{$id},id",
            'duration'        => 'required|numeric',
            'duration_metric' => 'required',
        ];
    }
}
