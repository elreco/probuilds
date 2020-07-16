<?php

namespace App\Http\Requests\Match;

use Illuminate\Foundation\Http\FormRequest;

class QueueTypeRequest extends FormRequest
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
            'queues' =>  'required|array',
            'locale' => 'required|string',
        ];
    }

    public function all($keys = null)
    {
        $data = parent::all($keys);
        /* $data['queues'] = $this->route('queues'); */
        return $data;
    }
}
