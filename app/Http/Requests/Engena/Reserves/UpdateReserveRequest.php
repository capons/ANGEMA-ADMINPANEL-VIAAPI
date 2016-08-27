<?php

namespace App\Http\Requests\Engena\Reserves;

use App\Http\Requests\Request;

class UpdateReserveRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return access()->allow('update-reserves');
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
            'ID'           => 'required|exists:tblreserves,ID',
            'RegionID'     => 'required|integer|exists:tblregions,ID',
            'ReserveName'  => "required|unique:tblreserves,ReserveName,{$id},ID",
            'Admin_Email'  => 'required|email',
            'activities'                => 'required|array',
            'passes'                    => 'required|array',
            'passes.*.pass_id'          => 'required|integer',
            'passes.*.price'            => 'required|numeric',
        ];
    }
}
