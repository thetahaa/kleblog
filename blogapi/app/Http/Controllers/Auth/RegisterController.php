<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;


class RegisterController extends Controller
{
    public function register(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ], $this->customMessages());

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Doğrulama hataları',
                'errors' => $validator->errors()
            ], 422);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user->assignRole('Writter');

        return response()->json(['message' => 'Kayıt başarılı'], 201);
    }

    private function customMessages()
    {
        return [
            'name.required' => 'İsim alanı zorunludur',
            'email.required' => 'E-posta alanı zorunludur',
            'email.email' => 'Geçerli bir e-posta adresi girin',
            'email.unique' => 'Bu e-posta zaten kullanılıyor',
            'password.required' => 'Şifre alanı zorunludur',
            'password.min' => 'Şifre en az 8 karakter olmalıdır',
            'password.confirmed' => 'Şifreler eşleşmiyor',
        ];
    }
}