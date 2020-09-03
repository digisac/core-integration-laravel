<?php

namespace DigiSac\Base\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanyRequest extends FormRequest
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
            'name' => 'required',
            'url' => 'required|url',
            'token' => 'required',
            'company_id' => 'required',
            'company_agnus_id' => 'required',
            'settings' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'O campo nome é obrigatório.',
            'url.required' => 'O campo URL é obrigatório.',
            'url.url'=>'O campo URL deve ser uma url válida.',
            'token.required' => 'O campo token é obrigatório.',
            'company_id.required' => 'O campo companyID é obrigatório.',
            'company_agnus_id.required' => 'O campo company agnus ID é obrigatório.',
            'settings.required' => 'O campo configurações é obrigatório.'
        ];
    }
}
