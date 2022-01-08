<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class OffresRequest extends Request
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
            'lieu' => 'required|max:60',
            'reference' => 'required|max:60',
            'categorie_id' => 'required|integer',
            'poste' => 'required|max:255',
            'description' => 'required'
        ];
    }
}
