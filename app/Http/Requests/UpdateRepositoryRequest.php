<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRepositoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->id === $this->repository->user_id;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        if($this->method() === 'PUT'){
            return [
                'user_id' => 'required|numeric',
                'url' => 'required|string|max:100',
                'description' => 'required|string|max:500'
            ];

        }else{
            return [
                'user_id' => 'sometimes|numeric',
                'url' => 'sometimes|string|max:100',
                'description' => 'sometimes|string|max:500'
            ];
        }

    }
}
