<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;

class DesenvolvedorResquest extends FormRequest
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
        $co_desenvolvedor = $this->desenvolvedor ?? null;

        return [
            'nm_desenvolvedor' => ['required', 'max:80', Rule::unique('desenvolvedores', 'nm_desenvolvedor')->ignore($co_desenvolvedor, 'co_desenvolvedor')],
            'ds_sexo' => 'required',
            'dt_nascimento' => 'required',
            'nu_idade' => 'required',
            'ds_hobby' => 'required|max:256',
            'co_nivel' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'required' => 'O campo :attribute é obrigatório.',
            'unique' => 'O :attribute já está cadastrado.',
            'max' => 'O campo :attribute deve conter no máximo :max caracteres.',
        ];
    }

    public function attributes()
    {
        return [
            'nm_desenvolvedor' => 'Nome do desenvolvedor',
            'ds_sexo' => 'Sexo',
            'dt_nascimento' => 'Data de nascimento',
            'nu_idade' => 'Idade',
            'ds_hobby' => 'Hobby',
            'co_nivel' => 'Nível',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->errors(),  Response::HTTP_NOT_ACCEPTABLE));
    }
}
