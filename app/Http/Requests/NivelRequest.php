<?php

namespace App\Http\Requests;

use GuzzleHttp\Psr7\Request;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;

class NivelRequest extends FormRequest
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
        $co_nivel = $this->nivel ?? null;

        return [
            'nm_nivel' => [Rule::unique('niveis', 'nm_nivel')->ignore($co_nivel, 'co_nivel')]
        ];
    }

    public function messages()
    {
        return [
            'required' => 'O campo :attribute é obrigatório.',
            'unique' => 'O :attribute já está cadastrado.'
        ];
    }

    public function attributes()
    {
        return [
            'nm_nivel' => 'Nível'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->errors(),  Response::HTTP_NOT_ACCEPTABLE));
    }
}
