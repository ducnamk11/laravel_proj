<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
{
    private $table = 'article';
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
        $conName ="bail|required|max:255|min:3|unique:$this->table,name";
        $conThumb ="bail|required|image|max:100000|min:100";

        if (!empty($id)) {
             $conName ="required|max:255|min:3|unique:$this->table,name,$id";  // == $conName .=",$id" 
             $conThumb ="image|max:100000|min:100";

         }
         return [
             'name' => $conName,
             'status' => 'bail|in:active,inactive',
             'thumb' => $conThumb,
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
