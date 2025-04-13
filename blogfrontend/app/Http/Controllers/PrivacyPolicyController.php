<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\PrivacyPolicy;


class PrivacyPolicyController extends Controller
{
    public function show()
{
    $response = Http::get('http://api_nginx/api/kvkk');
    
    if ($response->successful()) {
        return view('kvkk', [
            'privacy_policy' => $response->json()
        ]);
    }

    abort(500, 'KVKK metni yüklenemedi');
}

}
