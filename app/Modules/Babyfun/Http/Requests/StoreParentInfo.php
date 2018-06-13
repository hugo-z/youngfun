<?php

namespace App\Modules\Babyfun\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreParentInfo extends FormRequest
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
            'unique_id' => 'unique:parent_info',
            'cell'      => 'unique:parent_info|digis:11|nullable',
            'wx_name'   => 'required',
            // 'gender'    => 
        ];
    }
}
