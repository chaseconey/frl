<?php

namespace App\Http\Requests;

use App\Models\Race;
use Illuminate\Foundation\Http\FormRequest;

class DriverVideoRequest extends FormRequest
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
            'race_id' => 'required|numeric|exists:App\Models\Race,id',
            'driver_id' => 'required|numeric|exists:App\Models\Driver,id',
            'video_url' => 'required|url',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'driver_id.required' => 'An assigned driver in this division is required.'
        ];
    }

    protected function prepareForValidation()
    {
        $race = Race::findOrFail($this->race_id);
        $driverId = auth()->user()->drivers->pluck('id', 'division_id')->get($race->division_id);

        $this->merge(['driver_id' => $driverId]);

    }

}
