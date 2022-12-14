<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditProdutctRequest extends FormRequest
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
            "name" => "required",
            "url" =>"required|image|mimes:jpeg,png,gif|max:2048"
        ];
    }

    public function messages()
    {
        return [
            "name.require"=>"O nome do Produto é Obrigatório",
            "url.require" => "A imagem é obrigatória",
            "url.image" => "O ficheiro deve ser uma imagem",
            "url.mimes" => "A Imagem deve ser do tipo jpeg, png,gif",
            "url.max" => "A imagem deve ter um tamanho máximo de 2MB"

        ];
    }
}
