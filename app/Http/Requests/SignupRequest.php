<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SignupRequest extends FormRequest
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
            'division_id' => 'required|exists:divisions,id',
            'type' => 'required',
            'f1_team_id' => 'required|exists:f1_teams,id',
            'f1_number_id' => 'required|exists:f1_numbers,id',
            'steam_friend_code' => 'required|numeric',
            'equipment' => 'required'
        ];
    }
}
