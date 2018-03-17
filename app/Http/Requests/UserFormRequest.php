<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Request;

class UserFormRequest extends FormRequest
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
        // Recupera o id do Usuário pela URI(segment1 => panel, segment2 => users, segment3 => id do usuário).
        // Necessário para que a validação unique ignore o próprio id ao validar se o campo é único na tabela do BD
        $id = $this->segment(3, 0);
        
        // A senha só é obrigatória no cadastro de usuários(method => POST). Na edição, é opcional(method => PUT)        
        $required_or_not = Request::isMethod('post') ? 'required' : 'nullable';
        return [
            'name' => 'required|min:5|max:30',
            'email' => "required|email|unique:users,email,$id",
            'password' => "$required_or_not|min:5|max:10",
            'confirm_password' => 'required_with:password|same:password',
        ];
    }
}
