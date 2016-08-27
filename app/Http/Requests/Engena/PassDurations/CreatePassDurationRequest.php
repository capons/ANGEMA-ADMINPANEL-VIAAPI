<?php

namespace App\Http\Requests\Engena\PassDurations;

use App\Http\Requests\Request;

class CreatePassDurationRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return access()->allow('create-pass-durations');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'            => 'required|string|unique:pass_durations',
            'duration'        => 'required|numeric',
            'duration_metric' => 'required',
        ];
    }
}
