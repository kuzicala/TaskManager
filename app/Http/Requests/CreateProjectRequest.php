<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreateProjectRequest extends Request
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
            'name'=>'required|unique:projects',
            'thumbnail'=>'image|dimensions:min_width=261,min_height=98'
        ];
    }

    public function messages()
    {
        return [
            'name.required'=>"项目名称必须",
            'name.unique'=>"项目名称已经存在",
            'thumbnail.image'=>"请上传图片格式",
            'thumbnail.dimensions'=>"宽度需要大于261，高度大于98"
        ];
    }

}
