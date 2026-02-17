<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class SubmitReturnRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Only admin can submit returns
        return auth()->check() && auth()->user()->role === 'admin';
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'body_condition' => ['required', 'string', 'min:5', 'max:500'],
            'interior_condition' => ['required', 'string', 'min:5', 'max:500'],
            'fuel_level' => ['required', 'string', 'max:100'],
            'accessories' => ['required', 'string', 'min:5', 'max:500'],
            'notes' => ['nullable', 'string', 'max:1000'],

            // Photo uploads
            'photos.damage.*' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:5120'], // 5MB per file
            'photos.interior.*' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:5120'],
            'photos.fuel.*' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:5120'],
            'photos.tire.*' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:5120'],
            'photos.exterior.*' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:5120'],
            'photos.accessories.*' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:5120'],
            'photos.general.*' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:5120'],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     */
    public function messages(): array
    {
        return [
            'body_condition.required' => 'Kondisi bodi harus diisi.',
            'body_condition.min' => 'Kondisi bodi minimal 5 karakter.',
            'interior_condition.required' => 'Kondisi interior harus diisi.',
            'interior_condition.min' => 'Kondisi interior minimal 5 karakter.',
            'fuel_level.required' => 'Level bahan bakar harus diisi.',
            'accessories.required' => 'Status aksesori harus diisi.',
            'accessories.min' => 'Status aksesori minimal 5 karakter.',
            'photos.*.image' => 'File harus berupa gambar.',
            'photos.*.mimes' => 'Format gambar harus jpeg, png, jpg, atau gif.',
            'photos.*.max' => 'Ukuran file tidak boleh lebih dari 5MB.',
        ];
    }

    /**
     * Get the input data from the request.
     */
    public function validated($key = null, $default = null): array
    {
        $validated = parent::validated($key, $default);

        // Process photos - group by category
        $validated['photos'] = [];
        foreach (['damage', 'interior', 'fuel', 'tire', 'exterior', 'accessories', 'general'] as $category) {
            $key = "photos.{$category}";
            if ($this->hasFile($key)) {
                $validated['photos'][$category] = $this->file($key);
            }
        }

        return $validated;
    }
}
