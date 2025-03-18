<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $response = Http::timeout(1000)->acceptJson()->post("http://api_nginx/api/login", [
            'email' => $request->email,
            'password' => $request->password,
        ]);
       
        $token = $response['token'];
        session(['token' => $token]);

        return redirect('/posts   ', 301, ['Authorization' => $token]);
    }

    public function logout(Request $request)
    {

        $user = Http::timeout(1000)->withToken(session('token'))->post("http://api_nginx/api/logout");
        if($user->successful())
        {
            session()->forget('token');
            return redirect('http://localhost:8003');
        }

    }
}
