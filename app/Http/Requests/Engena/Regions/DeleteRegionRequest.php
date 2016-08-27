<?php

namespace App\Http\Requests\Engena\Regions;

use App\Http\Requests\Request;

class DeleteRegionRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return access()->allow('delete-regions');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            // 'ID' => 'required|!exists:tblreserves,RegionID',
        ];
    }
}
