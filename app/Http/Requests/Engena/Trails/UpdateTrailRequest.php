<?php

namespace App\Http\Requests\Engena\Trails;

use App\Http\Requests\Request;

class UpdateTrailRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return access()->allow('update-trails');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id = app('request')->input('ID');

        return [
            'ID'               => 'required|exists:tbltrails,ID',
            'ReserveID'        => 'required|integer|exists:tblreserves,ID',
            'ActivityID'       => 'required|integer|exists:tblactivities,ID',
            'TrailName'        => "required|unique:tbltrails,TrailName,{$id},ID",
            'TrailDescription' => 'required|string',
            'TrailMapURL'      => 'required|url',
        ];
    }
}
