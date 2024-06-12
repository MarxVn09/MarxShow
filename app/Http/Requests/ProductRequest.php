<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [

            'name'=>'bail|required|unique:products|max:255|min:10',
            'price'=>'required',
            'contents'=>'required',
            'category_id'=>'required',
        ];
    }
    // chinh sua noi dung tin
//    public function messages()
//    {
//        return [
//            'name.required'=>'Name Must Have',
//            'name.unique'=>'',
//            'name.max'=>'',
//        ];
//    }
}
