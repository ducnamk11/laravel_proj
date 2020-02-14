<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{
    private $table = 'category';
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
        $id  = $this->id; 
         $conName ="required|max:255|min:3|unique:$this->table,name";

        if (!empty($id)) {
             $conName ="required|max:255|min:3|unique:$this->table,name,$id";  // == $conName .=",$id" 
        }
        return [
           'name' => $conName,
           'status' => 'bail|in:active,inactive',
        ];
   }

   public function messages()
   {
    return [
        // 'name.required' => 'Name không được rỗng !',
        // 'name.min' => 'Name :input có chiều dài ít nhất :min kí tự !',
        // 'body.required'  => 'A message is required',
    ];
}

public function attributes()
{
    return [
        // 'description' => 'Field description: ',
    ];
}
}
