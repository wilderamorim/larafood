<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateCategoryRequest extends FormRequest
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
        $slug = $this->segment(3);

        return [
            'name'          => "required|min:3|max:255|unique:categories,name,{$slug},slug",
            'description'   => 'nullable|min:3|max:255',
        ];
    }
}
