<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTourPackageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
     public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'description' => 'nullable|string',
            'duration' => 'nullable|string|max:100',
            'max_participants' => 'nullable|integer|min:1',
            'price' => 'required|numeric|min:0',
            'location' => 'nullable|string|max:255',
            'itinerary' => 'nullable|string',
            'inclusions' => 'nullable|string',
            'exclusions' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
            'gallery.*' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
        ];
    }
}
