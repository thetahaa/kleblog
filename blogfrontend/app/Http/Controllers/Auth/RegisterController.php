<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Exception;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        try {
            $response = Http::timeout(100)->post("http://api_nginx/api/register", [
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password,
                'password_confirmation' => $request->password_confirmation,
            ]);

            if ($response->successful()) {
                return redirect()->route('login') 
                    ->with('success', 'Kayıt işlemi başarılı. Giriş yapabilirsiniz.');
            }

            $errorData = $response->json();

            return back()
                ->withErrors($errorData['errors'] ?? ['general' => $errorData['message'] ?? 'Kayıt işlemi sırasında bir hata oluştu.'])
                ->withInput($request->except('password', 'password_confirmation'));

        } catch (Exception $e) {
            $errorMessage = 'API ile bağlantı kurulamadı. Lütfen daha sonra tekrar deneyin.';
            
            if (method_exists($e, 'hasResponse') && $e->hasResponse()) {
                $errorData = json_decode($e->getResponse()->getBody(), true);
                $errorMessage = $errorData['message'] ?? $errorMessage;
            }

            return back()
                ->withErrors(['general' => $errorMessage])
                ->withInput($request->except('password', 'password_confirmation'));
        }
    }
}