<?php

namespace App\Http\Requests\Champion;

use Illuminate\Foundation\Http\FormRequest;

class SpellsRequest extends FormRequest
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
            'name' => 'required|string|max:30',
            'locale' => 'required|string',
            'id' => 'required|string'
        ];
    }

    public function all($keys = null)
    {
        $data = parent::all($keys);
        $data['name'] = $this->route('name');
        $data['id'] = $this->route('id');
        return $data;
    }
}
