<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
{
    $response = Http::timeout(30)
        ->acceptJson()
        ->post("http://api_nginx/api/login", [
            'email' => $request->email,
            'password' => $request->password,
        ]);

    if ($response->successful()) {
        $token = $response->json('token');
        session(['token' => $token]);
        return redirect('/posts')->with('success', 'Giriş başarılı!');
    }

    $errors = [];
    
    if ($response->status() === 422 || $response->status() === 401) {
        $errorData = $response->json();
        $errors = $errorData['errors'] ?? [];
    } else {
        $errors['general'] = 'Bir hata oluştu, lütfen tekrar deneyin';
    }

    return back()
        ->withErrors($errors)
        ->withInput($request->except('password'));
}

    public function logout(Request $request)
    {
        $response = Http::timeout(30)
            ->withToken(session('token'))
            ->post("http://api_nginx/api/logout");

        if ($response->successful()) {
            session()->forget('token');
            return redirect('http://localhost:8003')
                ->with('success', 'Çıkış yapıldı!');
        }

        return back()->withErrors([
            'logout_error' => 'Çıkış işlemi başarısız oldu'
        ]);
    }
}