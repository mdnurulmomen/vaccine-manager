<?php

namespace App\Http\Requests;

use App\Models\VaccineCenter;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class UserVaccineStoreRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'schedule' => [
                'required', 'date'
            ],

            'vaccine_center_id' => [
                'required', 'integer', 'exists:vaccine_centers,id'
            ],

            'user_id' => [
                'required', 'integer', 'exists:users,id'
            ]
        ];
    }

    /**
     * Get the "after" validation callables for the request.
     */
    public function after(): array
    {
        return [
            function (Validator $validator) {
                $vaccineCenter = VaccineCenter::find($this->input('vaccine_center_id'));
                $numberAssignedUsers = DB::table('user_vaccines')->whereDate('schedule', $this->input('schedule'))
                ->where('vaccine_center_id', $this->input('vaccine_center_id'))->count();

                if ($numberAssignedUsers >= $vaccineCenter->maximum_vaccine_per_day) {
                    $validator->errors()->add(
                        'schedule',
                        'This center is booked for selected schedule'
                    );
                }
            }
        ];
    }
}
