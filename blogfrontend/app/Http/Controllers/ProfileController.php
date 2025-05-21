<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ProfileController extends Controller
{
    public function show()
    {
        try {
            $response = Http::withToken(session('token'))->get("http://api_nginx/api/profile");
            
            if ($response->successful()) {
                $profile = $response->json();
                return view('profile', compact('profile'));
            }

            return back()->withError('Profil yüklenirken bir hata oluştu');

        } catch (\Exception $e) {
            return back()->withError('API bağlantı hatası: Lütfen daha sonra tekrar deneyin');
        }
    }

    public function update(Request $request)
    {
        try {
            $response = Http::withToken(session('token'))
                ->put("http://api_nginx/api/profile", $request->all());

            if ($response->successful()) {
                return back()->with('success', 'Profil güncellendi');
            }

            $errors = $response->json()['errors'] ?? ['Genel bir hata oluştu'];
            return back()->withErrors($errors);

        } catch (\Exception $e) {
            return back()->withError('İstek gönderilirken bir hata oluştu: '.$e->getMessage());
        }
    }
}