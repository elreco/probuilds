<?php

namespace App\Http\Requests\Summoner;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Entities\RegionEntity;

class ShowRequest extends FormRequest
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

    public function validationData()
    {
        $all = parent::validationData();
        //Convert request value to lowercase
        if (!empty($all['region'])) {
            $all['region'] = strtolower($all['region']);
        }

        return $all;
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'locale' => 'required|string',
            'summonerId' => 'required|string|max:150',
        ];
    }
}
