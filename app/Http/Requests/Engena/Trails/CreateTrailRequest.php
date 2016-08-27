<?php

namespace App\Http\Requests\Engena\Trails;

use App\Http\Requests\Request;

class CreateTrailRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return access()->allow('create-trails');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'ReserveID'        => 'required|integer|exists:tblreserves,ID',
            'ActivityID'       => 'required|integer|exists:tblactivities,ID',
            'TrailName'        => 'required|unique:tbltrails',
            'TrailDescription' => 'required|string',
            'TrailMapURL'      => 'required|url',
        ];
    }
}
