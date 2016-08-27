<?php

namespace App\Http\Requests\Engena\Regions;

use App\Http\Requests\Request;

class UpdateRegionRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return access()->allow('update-regions');
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
            'ID'            => 'required|exists:tblregions,ID',
            'Country'       => 'required|string',
            'StateProvince' => 'required|string',
            'Region'        => "required|string|unique:tblregions,Region,{$id},ID",
        ];
    }
}
