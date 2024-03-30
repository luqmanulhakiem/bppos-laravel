<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;

class AkunRequest extends FormRequest
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
        $user = User::where('id', auth()->user()->id)->first();
        $password = $user->password; //hasing pass and i want to un hashing to cek same value

        return [
            'username' => 'required|string',
            'oldPassword' => ['required', 'min:8', function ($attribute, $value, $fail) use ($password) {
                if (!Hash::check($value, $password)) {
                    $fail('The old password does not match.');
                }
            },],
            'newPassword' => 'required|min:8',
        ];
    }
}
