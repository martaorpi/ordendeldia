<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EducativeOfferRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // only allow updates if the user is logged in
        return backpack_auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            // 'name' => 'required|min:5|max:255'
            'academic_unit_id ' => 'required',
            'short_name' => 'required|max:255',
            'long_name' => 'required|max:255',
            'abbreviation' => 'required|max:255',
            'current' => 'required',
            'registration_date' => 'required',
            'title' => 'required|max:255',
            'duration_regularity' => 'required',
            'years_duration' => 'required',
            'quota' => 'required',
        ];
    }

    /**
     * Get the validation attributes that apply to the request.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            //
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            //
        ];
    }
}
