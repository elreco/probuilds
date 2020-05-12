<?php

namespace App\Http\Requests\Match;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Entities\RegionEntity;

class MatchRequest extends FormRequest
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
            'summonerId' => 'required|string|max:60',
            'matchId' =>  'required|string|max:60',
            'region' => [
                'required',
                Rule::in(array_map('strtoupper', RegionEntity::$list))
            ],
        ];
    }
}
