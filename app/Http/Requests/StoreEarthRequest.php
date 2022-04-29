<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEarthRequest extends FormRequest
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
            'gender' => 'required',
            'enumber' => 'required|integer',
            'space' => 'required|integer',
            'square_id' => 'required'
        ];

    }

    public function messages()
    {
        return [

            'name.required' =>'يرجي ادخال الاسم ',
            'gender.required' =>'يرجي ادخال النوع ',
            'enumber.required' =>'يرجي ادخال رقم القطعة ',
            'enumber.integer' =>'رقم القطعة يجب ان يكون ارقام صحيحة',
            'space.required' =>'يرجي ادخال المساحة ',
            'space.integer' =>'مساحة القطعة يجب ان تكون ارقام صحيحة',
            'square_id.required' =>'يرجي ادخال المربع '
        ];
    }






}
