<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostFormRequest extends FormRequest
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
        // Recupera o id do Usuário pela URI(segment1 => panel, segment2 => posts, segment3 => id do usuário).
        // Necessário para que a validação unique ignore o próprio id ao validar se o campo é único na tabela do BD
        $id = $this->segment(3, 0);
        
        return [
            'title' => "required|min:5|max:50|unique:posts,title,$id",
            'description' => 'required|min:10|max:1200'
        ];
    }
}
