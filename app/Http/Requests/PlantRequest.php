<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PlantRequest extends FormRequest
{
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
     * @return array<string, string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:100',
            'plant_species_id' => 'required|exists:plant_species,id',
            'room_id' => 'required|exists:rooms,id',
            'acquired_at' => 'required|date|before_or_equal:today',
            'watering_interval' => 'required|integer|min:1|max:60',
            'condition' => 'required|in:Отличное,Хорошее,Удовлетворительное,Требует ухода',
            'notes' => 'nullable|string|max:1000',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ];
    }
}
