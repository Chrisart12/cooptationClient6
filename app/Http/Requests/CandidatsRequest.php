<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CandidatsRequest extends Request
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
     *
     */
    public function rules()
    {
        return [
            'lastName' => 'required|min:2|max:60|alpha',
            'firstName' => 'required|min:2|max:60|alpha',
            'reference' => 'required|min:2|max:60'
        ];
    }
}
