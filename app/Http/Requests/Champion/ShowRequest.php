<?php

namespace App\Http\Requests\Champion;

use Illuminate\Foundation\Http\FormRequest;

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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:30',
        ];
    }

    public function all($keys = null)
    {
        $data = parent::all($keys);
        $data['name'] = $this->route('name');
        return $data;
    }
}
