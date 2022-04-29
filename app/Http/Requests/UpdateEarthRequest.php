<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEarthRequest extends FormRequest
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
            'name' => 'required',
            'enumber' => 'integer',
            'space' => 'integer',
            'gender' => 'required',
            'square_id' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'يرجى ادخال الاسم',
            'gender.required' => 'يرجى ادخال النوع',
            'square_id.required' => 'يرجى ادخال المربع',
            'enumber.integer' =>'يرجي ادخال رقم القطعة ارقام صحيحة',
            'space.integer' =>'يرجي ادخال مساحة القطعة ارقام صحيحة'
      
        ];
    }



}
