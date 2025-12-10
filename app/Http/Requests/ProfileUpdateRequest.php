<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;


class ProfileUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    
    public function rules(): array
    {
        $userId = Auth::user()->user_id;
        return [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:35',
                Rule::unique('Users', 'email')->ignore($this->user()->user_id, 'user_id'),
            ],

            'phone_no' => ['required', 'regex:/^01[3-9][0-9]{8}$/'],
            'student_id' => ['required', 'integer',
                Rule::unique('users', 'student_id')->ignore($this->user()->user_id, 'user_id'),
            ],
            
            'default_location' => ['required', 'string'],
            'department' => ['required', 'string', 'max:255'],
            'avatar' => 'nullable|string',
        ];
    }
}
