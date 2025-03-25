<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Http;


class ProfileController extends Controller
{
    public function show()
    {
        $response = Http::withToken(session('token'))->get("http://api_nginx/api/profile");
        
        if ($response->successful()) {
            $profile = $response->json();
            return view('profile', compact('profile'));
        }

        return back()->withError('Profil yüklenemedi');
    }

    public function update(Request $request)
    {
        $response = Http::withToken(session('token'))
            ->put("http://api_nginx/api/profile", $request->all());
        
        if ($response->successful()) {
            return back()->with('success', 'Profil güncellendi');
        }

        return back()->withErrors($response->json()['errors']);
    }
}
