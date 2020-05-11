<?php

namespace App\Http\Requests\LiveFeed;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Entities\RegionEntity;
use App\Entities\Riot\RiotEntity;

class LiveFeed extends FormRequest
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
            'page' => 'integer|max:3',
            'champion' => 'nullable|string|max:30',
            'lane' =>  [
                'nullable',
                Rule::in(RiotEntity::$lanes)
            ],
            'region' => [
                'nullable',
                Rule::in(array_map('strtoupper', RegionEntity::$list))
            ],
        ];
    }
}
