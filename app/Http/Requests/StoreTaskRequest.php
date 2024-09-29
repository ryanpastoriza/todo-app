<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;
use App\Enums\Priority;
use Illuminate\Validation\Rule;
// use App\Traits\JsonResponseWithStatus;

class StoreTaskRequest extends FormRequest
{
    // use JsonResponseWithStatus;
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'max:255'],
            'description' => ['required'],
            'due_date' => ['nullable', 'date_format:Y-m-d', 'after:today'],
            'tags' => ['nullable', 'array', 'min:0', 'exists:tag,id'],
            'priority' => ['nullable', Rule::in(Priority::names())],
        ];
    }


    protected function failedValidation(Validator $validator)
    {
        throw new ValidationException(
            $validator, 
            response()->json([
                'message' => 'The given data is invalid', 
                'errors' => $validator->errors()
            ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY)
        );
    }
}
