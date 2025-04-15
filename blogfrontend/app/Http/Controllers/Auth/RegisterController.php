<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\RequestException;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        try {
            $response = Http::timeout(1000)->post("http://api_nginx/api/register", [
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
            $errors = [];

            if (isset($errorData['errors'])) {
                foreach ($errorData['errors'] as $field => $messages) {
                    $errors[$field] = is_array($messages) ? $messages[0] : $messages;
                }
            } 
            else {
                $errors['general'] = $errorData['message'] ?? 'Kayıt işlemi sırasında bir hata oluştu.';
            }

            return back()
                ->withErrors($errors)
                ->withInput($request->except('password', 'password_confirmation'));

        } catch (RequestException $e) {
            $errorMessage = 'API ile bağlantı kurulamadı. Lütfen daha sonra tekrar deneyin.';
            
            if ($e->hasResponse()) {
                $errorData = $e->response->json();
                $errorMessage = $errorData['message'] ?? $errorMessage;
            }

            return back()
                ->withErrors(['api_error' => $errorMessage])
                ->withInput($request->except('password', 'password_confirmation'));
        }
    }
}