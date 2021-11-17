<?php
  
namespace App\Http\Requests;
  
use Illuminate\Foundation\Http\FormRequest;
  
class StudentRequestFrontend extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    /*public function authorize()
    {
        return false;
    }*/
  
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'last_name' => 'required|min:5|max:255',
            'first_name' => 'required|min:5|max:255',
            'dni' => 'required|max:8|min:7|unique:students,dni,'. auth()->user()->student[0]->id 
        ];
    }

    
}