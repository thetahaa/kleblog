<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\PrivacyPolicy;


class PrivacyPolicyController extends Controller
{
    public function showKvkk()
    {
        $response = Http::withToken(session('token'))
            ->get("http://api_nginx/api/kvkk");

        if ($response->successful()) {
            return view('kvkk', [
                'kvkk' => $response->json()
            ]);
        }

        abort(500, 'KVKK metni yüklenemedi');
    }

    public function showPrivacyPolicy()
    {
        $response = Http::withToken(session('token'))
            ->get("http://api_nginx/api/gizlilik-politikasi");

        if ($response->successful()) {
            return view('gizlilik-politikasi', [
                'privacy_policy' => $response->json()
            ]);
        }

        abort(500, 'Gizlilik politikası yüklenemedi');
    }

}
