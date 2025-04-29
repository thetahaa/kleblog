<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Http\JsonResponse;


class LoginController extends Controller
{
    public function login(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:8',
        ], [
            'email.required' => 'E-posta alanı zorunludur',
            'email.email' => 'Geçerli bir e-posta formatı girin',
            'password.required' => 'Şifre alanı zorunludur',
            'password.min' => 'Şifre en az 8 karakter olmalıdır',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Doğrulama hataları',
                'errors' => $validator->errors()
            ], 422);
        }

        $credentials = $request->only('email', 'password');
    
        if (!Auth::attempt($credentials)) {
            $errors = [];
            
            if (!User::where('email', $request->email)->exists()) {
                $errors['email'] = 'Bu e-posta ile kayıtlı kullanıcı bulunamadı';
            } else {
                $errors['password'] = 'Şifre geçersiz yada hatalı';
            }

            return response()->json([
                'message' => 'Kimlik doğrulama hatası',
                'errors' => $errors
            ], 401);
        }

        $user = Auth::user();
        $token = $user->createToken($user->name.'-AuthToken')->plainTextToken;

        return response()->json([
            'message' => 'Başarıyla giriş yapıldı',
            'token' => 'Bearer '.$token,
            'user' => $user
        ], 200);
    }

    public function logout(Request $request): JsonResponse
    {
        try {
            $request->user()->tokens()->delete();
            return response()->json([
                'message' => 'Başarıyla çıkış yapıldı'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Çıkış sırasında hata oluştu'
            ], 500);
        }
    }

    public function profile(Request $request): JsonResponse
    {
        return response()->json([
            'message' => 'Kullanıcı bilgileri',
            'data' => $request->user()
        ], 200);
    }
}