<?php

namespace App\Http\Requests\village_detail;

use Illuminate\Foundation\Http\FormRequest;

class EditVillageDetailRequest extends FormRequest
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
            'board_id' => "required",
            'sr_no' => "required",
            'village_name' => "required",
            'land_source_id' => "required",
            'land_address' => "required",
            'district' => "required",
            'taluka' => "required",
            'total_area' => "required",
            'possession_date' => "required",
            'remark' => "required",
            'mhada_name' => "required",
            'property_card' => "required",
            'property_card_mhada_name' => "required",
            'land_cost' => "required",
        ];
    }
}
