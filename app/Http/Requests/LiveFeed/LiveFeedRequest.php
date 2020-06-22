<?php

namespace App\Http\Requests\LiveFeed;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Entities\RegionEntity;
use App\Entities\Riot\RiotEntity;

class LiveFeedRequest extends FormRequest
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
            'page' => 'required|integer|max:3',
            'champion' => 'nullable|string|max:30',
            'lane' =>  [
                'required',
                Rule::in(RiotEntity::$lanes)
            ],
            'region' => [
                'nullable',
                Rule::in(array_map('strtolower', RegionEntity::$list))
            ],
        ];
    }
}
