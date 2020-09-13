<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class CreateShortLink extends FormRequest
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

    public function messages()
    {
        return [
            'original_link.required' => 'Поле "Целевая ссылка" обязательно для заполнения',
            'expiry_date.after' => 'Нельзя указать прошедшую дату',
            'custom_link.regex' => 'Сокращенная ссылка может состоять только из латиницы и чисел',
            'custom_link.max' => 'Максимальное количество символов "сокращенной ссылки" - 16',
        ]; // TODO: Change the autogenerated stub
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'original_link' => 'required|valid_link',
            'custom_link' => 'unique_name_link|max:16',
            'expiry_date'=>'required|date|after:'.Carbon::now()
        ];
    }
}
