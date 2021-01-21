<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProtestRequest extends FormRequest
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
            "driver_id" => "required|exists:drivers,id",
            "protested_driver_id" => "required|exists:drivers,id",
            "race_id" => "required|exists:races,id",
            "video_url" => "required|url",
            "description" => "required",
            "rules_breached" => "required"
        ];
    }
}
