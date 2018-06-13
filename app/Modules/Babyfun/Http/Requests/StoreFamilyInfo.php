<?php

namespace App\Modules\Babyfun\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFamilyInfo extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            // parent data
            'unique_id'     => 'unique:parent_info|nullable',
            'cell'          => 'unique:parent_info|digis:11|required',
            'parent.nickname'      => 'required',
            'parent.city'          => 'required|string',
            'parent.province'      => 'required|string',
            'parent.country'       => 'required|string',
            'parent.language'      => 'required|string',

            // kid data
            'kid.kidName'           => 'required|digits:10',
            'kid.choosenGender'         => 'required',
            'kid.kidBday'           => 'required',
        ];
    }
}
